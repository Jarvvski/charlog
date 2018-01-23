<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Log;

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
}
