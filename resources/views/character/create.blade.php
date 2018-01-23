@extends('layouts.app')

@section('title', 'create character')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Create Character</div>

				<div class="panel-body">
				{!! Form::open(['route' => ['character.save', $character->id]]) !!}
				<div class="form-group">
					{!! Form::label('name', 'Name') !!}
					{!! Form::text('name', '', ['class' => 'form-control']) !!}
					<span id="helpBlock" class="help-block">Name of the character</span>
				</div>

				<div class="form-group">
					{!! Form::label('race_id', 'Race') !!}
					<select class="form-control" name="race_id">
						<option value="" selected disabled>Select Race...</option>
						@foreach($races as $race)
							<option value="{{ $race->id }}">{{$race->name}}</option>
						@endforeach
					</select>
					<span id="helpBlock" class="help-block">Race to choose</span>
				</div>

				<div class="form-group">
					{!! Form::label('starting_experience', 'Starting XP') !!}
					{!! Form::number('starting_experience', '0', ['class' => 'form-control']) !!}
					<span id="helpBlock" class="help-block">Base experience for this character, regardless of race or records</span>
				</div>

				<button class="btn btn-primary" type="submit">Create Character</button>
				{!! Form::close() !!}

			</div>
		</div>
	</div>
</div>
</div>
@endsection