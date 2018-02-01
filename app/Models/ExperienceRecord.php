<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ExperienceRecord extends Model
{
	use Sortable;

	/**
	 * The sortable attributes for this model.
	 * 
	 * @var string
	 */
	public $sortable = [
		'id', 'amount'
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
}
