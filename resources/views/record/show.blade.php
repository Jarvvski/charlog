@extends('layouts.app')

@section('title', 'An epic tale')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="jumbotron">
				<h1>{{ $record->title }}</h1>
				<h4><span class="label label-primary">{{ $record->amount }}</span> experience earnt!</h4>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<p>
						{{ $record->source }}
					</p>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body"><h2>Those involved</h5></div>
			</div>
			@foreach($record->characters->chunk(2) as $chunk)
				<div class="row">
				@foreach($chunk as $character)
				<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-body">
								<a href="{{ route('character.show', $character->id) }}">
									<h3>{{ $character->name }}</h3>
								</a>
								<span class="label label-info">Tier {{ $character->tier }} {{ $character->race->name }}</span>
							</div>
						</div>
					</a>
				</div>
				@endforeach
				</div>
			@endforeach
		</div>
	</div>
</div>
@endsection