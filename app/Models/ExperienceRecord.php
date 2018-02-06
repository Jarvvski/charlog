<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Nicolaslopezj\Searchable\SearchableTrait;

class ExperienceRecord extends Model
{
	use Sortable, SearchableTrait;

	/**
	 * The sortable attributes for this model.
	 * 
	 * @var [string]
	 */
	public $sortable = [
		'id', 'amount'
	];

	/**
	 * Searchable dependency handler
	 * 
	 * @var [string]
	 */
	protected $searchable = [
		'columns' => [
			'experience_records.title' => 10,
			'experience_records.amount' => 7,
			'experience_records.source' => 5,
			'characters.name' => 7,
		],

		'joins' => [
			'character_experience_record' => [
				'character_experience_record.experience_record_id',
				'experience_records.id'
			],
			'characters' => [
				'character_experience_record.character_id',
				'characters.id'
			],
		],
	];

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'experience_records';

	/**
	 * 
	 */
	protected $fillable = [
		'source', 'amount'
	];

	public function characters()
	{
		return $this->belongsToMany('App\Models\Character')
			->using('App\Models\CharacterExperienceRecord');
	}

	public function formattedDate($format = null)
	{	
		if (!$format) {
	    	return Carbon::parse($this->record_date)->format('m/d/Y');
		} else {
			return Carbon::parse($this->record_date)->format($format);
		}
	}

	public function generateButtons()
	{
		$html = '
			<a href='.route("record.show", $this->id).' class="btn btn-success btn-sm" role="button"><i class="fas fa-eye"></i></a>
		';

		if (\Auth::check()) {
			$html .= '
				<a href='.route("record.edit", $this->id).' class="btn btn-primary btn-sm" role="button"><i class="fas fa-edit"></i></a>
			';
			$html .= '
				<form method="POST" action='.route("record.delete", $this->id).' accept-charset="UTF-8" class="form-inline form-delete"><input name="_method" value="DELETE" type="hidden">'.csrf_field().'
									<input name="id" value="'.$this->id.'" type="hidden">
									<button class="btn btn-sm btn-danger delete" type="submit" name="delete_modal" style="display:inline-block"><i class="fas fa-trash" aria-hidden="true"></i></button>
									</form>
			';
		}

	    return $html;
	}
}
