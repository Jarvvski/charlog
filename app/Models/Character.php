<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ExperienceRecord as Record;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Log;
use Nicolaslopezj\Searchable\SearchableTrait;

class Character extends Model
{
	use Sortable, SearchableTrait;

	/**
	 * The sortable attributes for this model.
	 * 
	 * @var [string]
	 */
	public $sortable = [
		'name', 'race'
	];

	/**
	 * Searchable dependency handler
	 * 
	 * @var [string]
	 */
	protected $searchable = [
		'columns' => [
			'characters.name' => 10,
			'races.name' => 5,
		],

        'joins' => [
            'races' => ['characters.race_id','races.id'],
        ],
	];


	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'characters';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'race'
	];

	/**
	 * The attributes that are computed
	 * 
	 * @var array
	 */
	protected $appends = [
		'tier', 'dice', 'health',
		'experience'
	];



	/**
	 * Default values
	 */
	const DEFAULT_HEALTH  = 25;
	const DEFAULT_DICE    = 20;
	const DEFAULT_TIER    = 1;
	const HEALTH_PER_TIER = 10;

	public function records()
	{
		return $this->belongsToMany('App\Models\ExperienceRecord')
			->using('App\Models\CharacterExperienceRecord');
	}

	public function race()
	{	
		return $this->belongsTo('App\Models\Race');
	}

	public function getTierAttribute()
	{
		$diceIndex = DB::table('dice_index')->where('experience_required', '<=', $this->experience)
				->orderBy('dice_sides', 'desc')
				->first();

		// TODO: This check could be better
		if (!$diceIndex) {
			return self::DEFAULT_TIER;
		}

		return $diceIndex->tier;
	}

	public function getDiceAttribute()
	{
		$diceIndex = DB::table('dice_index')->where('experience_required', '<=', $this->experience)
				->orderBy('dice_sides', 'desc')
				->first();

		// TODO: This check could be better
		if (!$diceIndex) {
			return self::DEFAULT_DICE;
		}

		return $diceIndex->dice_sides;
	}

	public function getHealthAttribute()
	{	
		$race = $this->race;
		$diceChange = $this->dice - self::DEFAULT_DICE;
		$diceHealth = $race->health_bonus * $diceChange;
		$tierHealth = ($this->tier - 1) * self::HEALTH_PER_TIER;

		return self::DEFAULT_HEALTH + $diceHealth + $tierHealth;
	}

	public function getExperienceAttribute()
	{
		$experience = 0;

		foreach ($this->records as $record) {
			$experience = $experience + $record->amount;
		}

		return $experience + $this->starting_experience;
	}

	// TODO: Would be much better to clean this up and handle inside ofthe view
	// 		but unsure how to handle that within the view without more JS frontend knowledge
	public function generateButtons()
	{
		$html = '
			<a href='.route("character.show", $this->id).' class="btn btn-success btn-sm" role="button"><i class="fas fa-eye"></i></a>
		';

		if (\Auth::check()) {
			$html .= '
				<a href='.route("character.edit", $this->id).' class="btn btn-primary btn-sm" role="button"><i class="fas fa-edit"></i></a>
			';
			$html .= '
				<form method="POST" action='.route("character.delete", $this->id).' accept-charset="UTF-8" class="form-inline form-delete"><input name="_method" value="DELETE" type="hidden">'.csrf_field().'
									<input name="id" value="'.$this->id.'" type="hidden">
									<button class="btn btn-sm btn-danger delete" type="submit" name="delete_modal" style="display:inline-block"><i class="fas fa-trash" aria-hidden="true"></i></button>
									</form>
			';
		}

	    return $html;
	}
}
