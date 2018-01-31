@extends('layouts.app')

@section('title', 'create record')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Character Record</div>
				
				<div class="panel-body">
					
					<!-- Form begin -->
					{!! Form::open(['route' => ['record.save', $record->id]]) !!}
	

						<!-- record title begin -->
						@if ($errors->get('title'))
							<div class="form-group has-error has-feedback">
								<label class="control-label" for="title">Record Title</label>
								<input type="text" class="form-control" id="title" name="title" aria-describedby="titleErrorStatus" value="{{ old('title') }}">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
								<span id="titleErrorStatus" class="sr-only">(error)</span>
								<span id="helpBlock" class="help-block">Event title</span>
							</div>
						@else
							<div class="form-group">
								{!! Form::label('title', 'Record Title') !!}
								{!! Form::text('title', $record->title, ['class' => 'form-control']) !!}
								<span id="helpBlock" class="help-block">Event title</span>
							</div>
						@endif
						<!-- record title end -->
						
						<!-- record exp begin -->
						@if ($errors->get('amount'))
							<div class="form-group has-error has-feedback">
								<label for="amount" class="control-label">Awarding amount</label>
								<input type="number" class="form-control" id="amount" name="amount" aria-describedby="amountErrorStatus" value="{{ old('amount') }}">
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
								<span id="amountErrorStatus" class="sr-only">(error)</span>
								<span id="helpBlock" class="help-block">Experience to award</span>
							</div>
						@else
							<div class="form-group">
								{!! Form::label('amount', 'Awarding amount') !!}
								{!! Form::number('amount', $record->amount, ['class' => 'form-control']) !!}
								<span id="helpBlock" class="help-block">Experience to award</span>
							</div>
						@endif
						<!-- record exp end -->
	
						<!-- record characters begin -->
						@if ($errors->get('characters'))
							<div class="form-group has-error">
								<label for="characters" class="control-label">Characters</label>
								<select multiple class="form-control" size=15 name="characters[]" aria-describedby="charErrorStatus">
									<option value="" disabled>Select Characters...
										<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
										<span id="charErrorStatus" class="sr-only"></span>
									</option>
									@foreach($characters as $character)
										@if(in_array($character->id, $recChars))
										<option selected="" value="{{ $character->id }}">{{$character->name}}</option>
										@else
											<option value="{{ $character->id }}">{{$character->name}}</option>
										@endif
									@endforeach
								</select>
								<span id="helpBlock" class="help-block">Characters associated with record. Hold CTRL + click | shift + click to select multiple</span>
							</div>
						@else
							<div class="form-group">
								{!! Form::label('characters[]', 'Characters') !!}
								<select multiple class="form-control" size=15 name="characters[]">
									<option value="" selected disabled>Select Characters...</option>
									@foreach($characters as $character)
										@if(in_array($character->id, $recChars))
										<option selected="" value="{{ $character->id }}">{{$character->name}}</option>
										@else
											<option value="{{ $character->id }}">{{$character->name}}</option>
										@endif
									@endforeach
								</select>
								<span id="helpBlock" class="help-block">Characters associated with record. Hold CTRL + click | shift + click to select multiple</span>
							</div>
						@endif
						<!-- record characters end -->
					
						<!-- record soure begin -->
						@if($errors->get('source'))
							<div class="form-group has-error has-feedback">
								<label for="source" class="control-label">Source of XP</label>
								<textarea class="form-control" name="source" id="source" cols="50" rows="10"></textarea>
								<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
								<span id="sourceErrorStatus" class="sr-only"></span>
								<span id="helpBlock" class="help-block">Paragraph detailing event</span>								
							</div>
						@else
							<div class="form-group">
								{!! Form::label('source', 'Source of XP') !!}
								{!! Form::textArea('source', $record->source, ['class' => 'form-control']) !!}
								<span id="helpBlock" class="help-block">Paragraph detailing event</span>
							</div>
						@endif

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

					<button class="btn btn-primary" type="submit">Update Record</button>
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
</div>
@endsection