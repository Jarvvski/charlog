@extends('layouts.app')

@section('title', $race->name)

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<div class="jumbotron">
				<h1>{{ $race->name }}</h1>

				<h4><span class="label label-primary">{{ $race->characters->sum('experience') }}</span> collective experience!</h4>
			</div>

			<div class="panel panel-default">
				<div class="panel-body">
					<h2>Quick Stats:</h2>
					<ul class="list-group">
						<li class="list-group-item"><strong>HP Bonus:</strong> {{ $race->health_bonus }}</li>
						<li class="list-group-item"><strong>Total members:</strong> {{ $race->characters->count() }}</li>
						<li class="list-group-item"><strong>Average Tier:</strong> {{ round($race->characters->average('tier'), 2) }}</li>
						<li class="list-group-item"><strong>Average Dice:</strong> {{ round($race->characters->average('dice'), 2) }}</li>
					</ul>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-body"><h2>Members: </h5></div>
			</div>

			@foreach($race->characters->chunk(2) as $chunk)
				<div class="row">
				@foreach($chunk as $character)
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-body">
							<a href="{{ route('character.show', $character->id) }}">
								<h3>{{ $character->name }}  <span class="label label-info">{{ $character->tier }}</span></h3>
							</a>
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