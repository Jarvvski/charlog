<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecord extends FormRequest
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
			'record_id' => 'unique:records',
			'title' => 'required|max:255',
			'amount' => 'required|integer|min:0',
			'characters.*' => 'required|integer',
			'source' => 'required|string|max:16777215'
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
			'title.required' => "A record title is required",
			'title.max' => "Your record title is too long",
			'amount.required' => "A record needs an exp value",
			'amount.integer' => "Record exp must be an interger",
			'amount.min' => "Record exp must be larger than 0",
			'characters.required' => "Record must have assigned characters",
			'characters.integer' => "Unrecognised characters provided",
			'source.required' => "A record source is required",
			'source.string' => "Record source must be alpha numeric",
			'source.max' => "Source text exceeds maximum length"
		];
	}
}
