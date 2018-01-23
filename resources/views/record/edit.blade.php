@extends('layouts.app')

@section('title', 'Edit record')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Character Record</div>
				
				<div class="panel-body">
				<div class="form-group">
					{!! Form::label('title', 'Record Title') !!}
					{!! Form::text('title', '', ['class' => 'form-control']) !!}
					<span id="helpBlock" class="help-block">Event title</span>
				</div>

				
				{!! Form::open(['route' => ['record.update', $record->id]]) !!}
				<div class="form-group">
					{!! Form::label('amount', 'Awarding amount') !!}
					{!! Form::number('amount', $record->amount, ['class' => 'form-control']) !!}
					<span id="helpBlock" class="help-block">Experience to award</span>
				</div>

				<div class="form-group">
					{!! Form::label('characters[]', 'Characters') !!}
					<select multiple class="form-control" name="characters[]">
						<option value="" disabled>Select Characters...</option>
						@foreach($characters as $character)
							@if(in_array($character->id, $recChars))
							<option selected="" value="{{ $character->id }}">{{$character->name}}</option>
							@else
								<option value="{{ $character->id }}">{{$character->name}}</option>
							@endif
						@endforeach
					</select>
					<span id="helpBlock" class="help-block">Characters associated with record. Hold CTRL to select multiple</span>
				</div>

				<div class="form-group">
					{!! Form::label('source', 'Source of XP') !!}
					{!! Form::textArea('source', $record->source, ['class' => 'form-control']) !!}
					<span id="helpBlock" class="help-block">Paragraph detailing event</span>
				</div>

				<button class="btn btn-primary" type="submit">Update Record</button>
				{!! Form::close() !!}

			</div>
		</div>
	</div>
</div>
</div>
@endsection