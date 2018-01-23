@extends('layouts.landing')

@section('title', 'Characters')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
					@foreach ($characters as $character)
						{{ $character->name }}
					@endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection