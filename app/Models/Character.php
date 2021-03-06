<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ExperienceRecord as Record;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Log;

class Character extends Model
{
	use Sortable;

	/**
	 * The sortable attributes for this model.
	 * 
	 * @var string
	 */
	public $sortable = [
		'name', 'race'
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
}
