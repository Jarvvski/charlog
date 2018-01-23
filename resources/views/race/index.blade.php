@extends('layouts.app')

@section('title', 'Races')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<div class="panel panel-default">
				<div class="panel-body"><h2>Races:</h5></div>
			</div>

			@foreach($races->chunk(2) as $chunk)
			<div class="row">
				@foreach($chunk as $race)
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-body">
								<h3>{{ $race->name }}</h3>
								<div class="row">							
									<ul class="list-inline">
										<div class="col-md-6">
											<li>
												<span class="label label-info">{{ $race->health_bonus }}</span> Bonus health
											</li>
										</div>
										<div class="col-md-6">
											<li>
												<span class="label label-primary">{{ $race->characters->count() }}</span> Characters
											</li>
										</div>
									</ul>
								</div>
								<div class="row">
									<ul class="list-inline">
										<div class="col-md-6">
											<li>
												<span class="label label-success">{{ $race->characters->sum('experience') }}</span> Total XP
											</li>
										</div>
										<div class="col-md-6">
											<li>
												<span class="label label-danger">{{ $race->characters->sum('dice') }}</span> Total dice
											</li>
										</div>
									</ul>
								</div>
								<hr>
								<div class="row">
									@if($race->characters->count() > 0)
									<div class="col-md-12">
										<p>Their most experience character is:
										<a href="{{ route('character.show', $race->characters->sortByDesc('experience')->first()->id ) }}"> {{ $race->characters->sortByDesc('experience')->first()->name }}</a></p>
										</p>
									</div>
									@endif
								</div>
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