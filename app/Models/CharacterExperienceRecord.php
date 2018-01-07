<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CharacterExperienceRecord extends Pivot
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'character_experience_record';
}