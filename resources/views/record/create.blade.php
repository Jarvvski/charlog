@extends('layouts.app')

@section('title', 'create record')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Create Character Record</div>
				
				<div class="panel-body">

					{!! Form::open(['route' => ['record.save', $record->id]]) !!}
					<div class="form-group">
						{!! Form::label('title', 'Record Title') !!}
						{!! Form::text('title', '', ['class' => 'form-control']) !!}
						<span id="helpBlock" class="help-block">Event title</span>
					</div>

					
					<div class="form-group">
						{!! Form::label('amount', 'Awarding amount') !!}
						{!! Form::number('amount', '0', ['class' => 'form-control']) !!}
						<span id="helpBlock" class="help-block">Experience to award</span>
					</div>

					<div class="form-group">
						{!! Form::label('characters[]', 'Characters') !!}
						<select multiple class="form-control" size=15 name="characters[]">
							<option value="" selected disabled>Select Characters...</option>
							@foreach($characters as $character)
							<option value="{{ $character->id }}">{{$character->name}}</option>
							@endforeach
						</select>
						<span id="helpBlock" class="help-block">Characters associated with record. Hold CTRL + click | shift + click to select multiple</span>
					</div>

					<div class="form-group">
						{!! Form::label('source', 'Source of XP') !!}
						{!! Form::textArea('source', '', ['class' => 'form-control']) !!}
						<span id="helpBlock" class="help-block">Paragraph detailing event</span>
					</div>

					<button class="btn btn-primary" type="submit">Create Record</button>
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
</div>
@endsection