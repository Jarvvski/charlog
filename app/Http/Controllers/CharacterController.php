<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Race;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCharacter;
use Illuminate\Support\Facades\Log;

class CharacterController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @param  \App\Models\Character  $character
	 * @return \Illuminate\Http\Response
	 */
	public function index(Character $character)
	{
		$characters = $character->sortable(['name' => 'asc'])->paginate(15);

		$viewParams = [
			'characters' => $characters
		];

		return view('character.index', $viewParams);
	}

	/**
	 * Create a new resource.
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$character = new Character;

		$viewParams = [
			'races' => Race::all(),
			'character' => $character
		];

		return view('character.create', $viewParams);
	}

	/**
	 * Show a specific resource.
	 *
	 * @param  \App\Models\Character
	 * @return \Illuminate\Http\Response
	 */
	public function show(Character $character)
	{
		$character = character::find($character->id);

		if (!$character) {
			// throw character does't exist
		}

		$viewParams = [
			'character' => $character
		];

		return view('character.show', $viewParams);
	}

	/**
	 * Update a resource in storage.
	 *
	 * @param  StoreCharacter  $request
	 * @param  \App\Models\Character
	 * @return \Illuminate\Http\Response
	 */
	public function update(StoreCharacter $request, Character $character)
	{
		$character = Character::find($character->id);
		
		if (!$character) {
			// throw err
		}

		$character->name = $request->input('name');
		$character->race_id = $request->input('race_id');
		$character->starting_experience = $request->input('starting_experience');
		$character->save();

		return redirect()->route('character.index')
		->with('message', 'Character created');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  StoreCharacter  $request
	 * @return \Illuminate\Http\Response
	 */
	public function save(StoreCharacter $request)
	{
		$character = new Character;
		$character->name = $request->input('name');
		$character->race_id = $request->input('race_id');
		$character->starting_experience = $request->input('starting_experience');
		$character->save();

		return redirect()->route('character.index')
		->with('message', 'Character created');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Character  $character
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Character $character)
	{
		if ($character) {
			$character = Character::find($character->id);
		} else {
			$character = new Character;
		}

		$viewParams = [
			'races' => Race::all(),
			'character' => $character
		];

		return view('character.edit', $viewParams);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Character  $character
	 * @return \Illuminate\Http\Response
	 */
	public function delete(Character $character)
	{   
		Log::info('checking for character with ID:'.$character->id);
		$character = Character::find($character->id);

		if (!$character) {
			// throw char doesn't exist
		}

		$character->delete();
		Log::alert('Character '.$character->id.' deleted');

		return redirect()->route('character.index')
		->with('message', 'Character deleted');;
	}
}
