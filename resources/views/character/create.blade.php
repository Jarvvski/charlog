@extends('layouts.app')

@section('title', 'create character')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Create Character</div>

					<div class="panel-body">
	
					<!-- Form begin -->
					{!! Form::open(['route' => ['character.save', $character->id]]) !!}

						<!-- Character name begin -->
						@if ($errors->get('name'))
							<div class="form-group has-error has-feedback">
								<label class="control-label" for="name">Character Name</label>
								<input type="text" class="form-control" id="name" name="name" aria-describedby="nameErrorStatus">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
								<span id="nameErrorStatus" class="sr-only">(error)</span>
								<span id="helpBlock" class="help-block">Name of the character</span>
							</div>
						@else
							<div class="form-group">
								{!! Form::label('name', 'Character Name') !!}
								{!! Form::text('name', '', ['class' => 'form-control']) !!}
								<span id="helpBlock" class="help-block">Name of the character</span>
							</div>
						@endif
						<!-- Character name end -->
					
						<!-- Character race begin -->
						@if ($errors->get('race_id'))
							<div class="form-group has-error has-feedback">
								<label for="race_id" class="control-label">Race</label>
								<select class="form-control" name="race_id">
									<option value="" selected disabled>Select Race...
										<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
										<span id="nameErrorStatus" class="sr-only"></span>
									</option>
									@foreach($races as $race)
										<option value="{{ $race->id }}">{{$race->name}}</option>
									@endforeach
								</select>
								<span id="helpBlock" class="help-block">Race of Character</span>
							</div>
						@else
							<div class="form-group">
								{!! Form::label('race_id', 'Race') !!}
								<select class="form-control" name="race_id">
									<option value="" selected disabled>Select Race...</option>
									@foreach($races as $race)
										<option value="{{ $race->id }}">{{$race->name}}</option>
									@endforeach
								</select>
								<span id="helpBlock" class="help-block">Race of Character</span>
							</div>
						@endif
						<!-- Character race end -->
					
						<!-- Character starting XP begin -->
						@if ($errors->get('starting_experience'))
							<div class="form-group has-error has-feedback">
								<label for="starting_experience" class="control-label">Starting Experience</label>
								<input type="number" class="form-control" id="starting_experience" name="starting_experience" aria-describedby="startingErrorStatus">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
								<span id="nameErrorStatus" class="sr-only">error</span>
								<span id="helpBlock" class="help-block">Base experience for this character, regardless of race or records</span>
							</div>
						@else
							<div class="form-group">
								{!! Form::label('starting_experience', 'Starting XP') !!}
								{!! Form::number('starting_experience', '', ['class' => 'form-control']) !!}
								<span id="helpBlock" class="help-block">Base experience for this character, regardless of race or records</span>
							</div>
						@endif
						<!-- Character starting XP end -->
			

						<!-- Error box begin -->
						@if ($errors->any())
							<div class="alert alert-danger">
								<ul class="list-unstyled">
									@foreach($errors->all() as $error)
										<li>
											<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
											<span class="sr-only">Error:</span>
											{{ $error }}
										</li>
									@endforeach
								</ul>
							</div>
						@endif
						<!-- Error box end -->
		
					<button class="btn btn-primary" type="submit">Create Character</button>
					{!! Form::close() !!}
					<!-- Form end -->

				</div>
			</div>
		</div>
	</div>
</div>
@endsection