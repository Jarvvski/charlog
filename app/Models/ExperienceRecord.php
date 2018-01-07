<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExperienceRecord extends Model
{
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
