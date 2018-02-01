<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCharacter extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		// TODO: needs work when sorting permission system
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'character_id' => 'unique:characters',
			'name' => 'required|max:255',
			'race_id' => 'required|exists:races,id|integer',
			'starting_experience' => 'required|integer|min:0',
		];
	}
	
	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'name.required'  => "A character name is required",
			'name.max' => "Character name is too long",
			'race_id.required' => "A race is required",
			'race_id.integer' => "Unexpected race selected",
			'starting_experience.required' => "Starting experience is required",
			'starting_experience.integer' => "Starting experience must be an numeric value"
		];
	}
}
