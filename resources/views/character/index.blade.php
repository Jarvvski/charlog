@extends('layouts.app')

@section('content')
@include('components.modal')

<div class="container">
	
	<!-- search box begin -->
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="form-group">
						<div class="col-xs-12">
							<input type="text" class="form-control search-box" id="search" placeholder="search...">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- search box end -->
	
	<!-- content box begin -->
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				
				@if (!$characters->isEmpty())
				<div class="table-responsive">
					<table class="table table-hover table-bordered" data-form="deleteForm">
						<thead>
							<tr>
								<th>@sortablelink('name')</th>
								<th>@sortablelink('race.name', 'Race')</th>
								<th>Tier</th>
								<th>Dice</th>
								<th>Health</th>
								<th>Experience</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="data">
							@foreach ($characters as $character)
							<tr>
								<td>{{ $character->name }}</td>
								<td>{{ $character->race->name }}</td>
								<td>{{ $character->tier }}</td>
								<td>{{ $character->dice }}</td>
								<td>{{ $character->health }}</td>
								<td>{{ $character->experience }}</td>
								<td class="text-center">
									<a href="{{ route('character.show', $character->id) }}" class="btn btn-success btn-sm" role="button"><i class="fas fa-eye"></i></a>
									@if (Auth::check())
									<a href="{{ url('admin/character/'. $character->id . '/edit')}}" class="btn btn-primary btn-sm" role="button"><i class="fas fa-edit"></i></a>

									{!! Form::model($character, ['method' => 'delete', 'route' => ['character.delete', $character->id], 'class' =>'form-inline form-delete']) !!}
									{!! Form::hidden('id', $character->id) !!}
									{!! Form::button('<i class="fas fa-trash" aria-hidden="true"></i>', ['class' => 'btn btn-sm btn-danger delete','type' => 'submit', 'name' => 'delete_modal','style'=>'display:inline-block']) !!}
									{!! Form::close() !!}
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@else
				<div class="panel-body">
					<p>No Characters found!</p>
				</div>
				@endif
			</div>
			<div class="text-center">
				{!! $characters->appends(\Request::except('page'))->render() !!}
			</div>
		</div>
	</div>
	<!-- search box end -->

</div>
@endsection

@section('scripts')
<script>
	$.ajaxSetup({
    	headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	}
	});
</script>
<script>
$('#search').on('keyup',function(){
	
	$value=$(this).val();
	console.log($value);

	$.ajax({
		type : 'get',
		url : '{{ route('character.search') }}',
		data:{'var':$value},
		success:function(data) {
			$('#data').html(data);
		},
		 error: function (xhr, status, error) {
			var err = eval("(" + xhr.responseText + ")");
			console.log(err);
		}
	});

});
</script>
@endsection
