@extends('layouts.app')

@section('title', $character->name)

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<div class="jumbotron">
				<h1>{{ $character->name }}</h1>

				<h4><span class="label label-primary">{{ $character->experience }}</span> experience earnt!</h4>
			</div>

			<div class="panel panel-default">
				<div class="panel-body">
					<h2>Quick Stats:</h2>
					<ul class="list-group">
						<li class="list-group-item"><strong>Tier:</strong> {{ $character->tier }}</li>
						<li class="list-group-item"><strong>Dice:</strong> {{ $character->dice }}</li>
						<li class="list-group-item"><strong>Health:</strong> {{$character->health }}</li>
						<li class="list-group-item"><strong>Race:</strong> {{$character->race->name }}</li>
					</ul>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-body"><h2>Past events</h5></div>
			</div>

			@foreach($character->records->chunk(2) as $chunk)
				<div class="row">
				@foreach($chunk as $record)
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-body">
							<a href="{{ route('record.show', $record->id) }}">
								<h3>{{ $record->title }}</h3>
							</a>
							<p><span class="label label-info">{{ $record->amount }}</span> experience awarded</p>
						</div>
					</div>
				</div>
				@endforeach
				</div>
			@endforeach
		</div>
	</div>
</div>
@endsection