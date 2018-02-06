<?php

namespace App\Http\Controllers;

use App\Models\ExperienceRecord as Record;
use App\Models\Character;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRecord;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RecordController extends Controller
{

	/**
	 * Display a listing of the resource.
	 * 
	 * @param  \App\Models\ExperienceRecord $record
	 * @return \Illuminate\Http\Response
	 */
	public function index(Record $record)
	{
		$records = $record->sortable(['id' => 'desc'])
			->paginate(10);

		$viewParams = [
			'records' => $records
		];

		return view('record.index', $viewParams);
	}
	
	/**
	 * Create a new resource.
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$record = new Record;

		$viewParams = [
			'characters' => Character::orderBy('name', 'asc')->get(),
			'record' => $record
		];

		return view('record.create', $viewParams);
	}

	/**
	 * Show a specific resource.
	 *
	 * @param  \App\Models\ExperienceRecord
	 * @return \Illuminate\Http\Response
	 */
	public function show(Record $record)
	{
		$record = Record::find($record->id);

		if (!$record) {
			// throw record does't exist
		}

		$viewParams = [
			'record' => $record
		];

		return view('record.show', $viewParams);
	}

	/**
	 * Search for resources.
	 * 
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function search(Request $request)
	{
	    if ($request->ajax()) {
	    	$output = "";
	    	Log::info('recieved request for record '. $request->var);
	    	$records = Record::search($request->var)->get();

	    	if ($records) {
	    		foreach($records as $record) {
	    			$output .= '<tr>'.
	    			'<td class="col-md-2 text-center">'.$record->amount.'</td>'.
	    			'<td class="col-md-2">'.$record->title.'</td>';

	    			$temp = "";
	    			foreach($record->characters as $character) {
	    				if($record->characters->last() === $character) {
	    					$temp .= "<span>".$character->name."</span>";
	    				} else {
	    					$temp .= "<span>".$character->name."</span>, ";
	    				}
	    			}
	    			$output .= "<td class='col-md-2'>${temp}</td>".
	    			'<td class="col-md-4">'.$record->source.'</td>'.
	    			'<td>'.$record->generateButtons().'</td>';
	    		}

	    		return Response($output);
	    	}
	    }
	}

	/**
	 * Update a resource in storage.
	 *
	 * @param  App\Http\Requests\StoreRecord $request
	 * @param  App\Models\ExperienceRecord
	 * @return \Illuminate\Http\Response
	 */
	public function update(StoreRecord $request, Record $record)
	{
		$record = Record::find($record->id);
		
		if (!$record) {
			// throw err
		}

		Log::info('editing record');
		$record->characters()->detach();

		// get assigned characters, and associate
		Log::info("Trying to associate characters with record");

		Log::info($request->input('characters'));
		$characters = Character::find($request->input('characters'));

		$record->record_date = Carbon::parse($request->input('date'));

		$record->title  = $request->input('title');
		$record->source = $request->input('source');
		$record->amount = $request->input('amount');
		
		$record->save();
		$record->characters()->attach($characters);
		
		return redirect()->route('record.index')
		->with('message', 'Record updated');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  App\Http\Requests\StoreRecord $request
	 * @return \Illuminate\Http\Response
	 */
	public function save(StoreRecord $request)
	{
		// creating record
		$record = new Record;

		Log::info('creating new record');
		// get assigned characters, and associate
		$characters = Character::find($request->input('characters'));

		$record->record_date = Carbon::parse($request->input('date'));

		$record->title  = $request->input('title');
		$record->source = $request->input('source');
		$record->amount = $request->input('amount');
		$record->save();

		$record->characters()->attach($characters);
		
		return redirect()->route('record.index')
		->with('message', 'Record created');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\ExperienceRecord
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Record $record)
	{
		if ($record) {
			$record = Record::find($record->id);
		}

		$charArr = [];
		foreach ($record->characters as $ch) {
			Log::info('Found char '.$ch->id.' with name '.$ch->name);
			$charArr[] = $ch->id;
		}

		$viewParams = [
			'characters' => Character::orderBy('name', 'asc')->get(),
			'record' => $record,
			'recChars' => $charArr
		];

		return view('record.edit', $viewParams);
	}

	/**
	 * Remove the specified resource from storage.
	 * 
	 * @param  \App\Models\ExperienceRecord
	 * @return \Illuminate\Http\Response
	 */
	public function delete(Record $record)
	{
		Log::info('Checking for record with ID:'.$record->id);
		$record = Record::find($record->id);

		if (!$record) {
			// throw record doesn't exist
		}

		$record->delete();
		Log::alert('Record '.$record->id.' deleted');

		return redirect()->route('record.index')
		->with('message', 'Record deleted');
	}
}
