<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RaceController extends Controller
{

	/**
	 * Display a listing of the resource.
	 * 
	 * @param  \App\Models\Race $race
	 * @return \Illuminate\Http\Response
	 */
	public function index(Race $race)
	{
		$viewParams = [
			'races' => Race::all()
		];

		return view('race.index', $viewParams);
	}

	/**
	 * Create a new resource.
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$race = new Race();

		$viewParams = [
			'race' => $race
		];

		return view('race.create', $viewParams);
	}

	/**
	 * Show a specific resource.
	 *
	 * @param  \App\Models\Race
	 * @return \Illuminate\Http\Response
	 */
	public function show(Race $race)
	{
		$race = Race::find($race->id);

		if (!$race) {
			// throw race doesn't exist
		}

		$characters = $race->characters;

		$viewParams = [
			'race' => $race,
			'characters' => $characters
		];

		return view('race.show', $viewParams);
	}

	/**
	 * Update a resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Race
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Record $record)
	{
		$race = Race::find($race->id);

		if (!$race) {
			// throw err
		}

		$race->name = $request->input('name');
		$race->health_bonus = $request->input('health_bonus');
		$race->save();

		return redirect()->route('race.index')
		->with('message', 'Race updated');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function save(Request $request)
	{
		$race = new Race;
		$race->name = $request->input('name');
		$race->health_bonus = $request->input('health_bonus');
		$race->save();

		return redirect()->route('race.index')
		->with('message', 'Race created');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Race
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Race $race)
	{
		if ($race) {
			$race = Race::find($race->id);
		}

		$viewParams = [
			'race' => $race
		];

		return view('race.edit', $viewParams);
	}

	/**
	 * Remove the specified resource from storage.
	 * 
	 * @param  \App\Models\Race
	 * @return \Illuminate\Http\Response
	 */
	public function delete(Race $race)
	{
		Log::info('Checking for race with ID:'.$race->id);
		$race = Record::find($record->id);

		if (!$race) {
			// throw race doesn't exist
		}

		$race->delete();
		Log::alert('race '.$race->id.' deleted');

		return redirect()->route('race.index')
		->with('message', 'Race deleted');
	}
}
