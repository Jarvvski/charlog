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

	<!-- main content begin -->	
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">

				@if (!$records->isEmpty())
				<div class="table-responsive ">
					<table class="table table-hover table-bordered" data-form="deleteForm">
						<thead>
							<tr>
								<th>@sortablelink('amount', 'XP Awarded')</th>
								<th>Title</th>
								<th>Characters</th>
								<th>Source</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="data">
							@foreach ($records as $record)
							<tr>
								<td class="col-md-2 text-center">{{ $record->amount }}</td>
								<td class="col-md-2">{{ $record->title }}</td>
								<td class="col-md-2">
									@foreach ($record->characters as $character)
									@if($record->characters->last() === $character)
									<span>{{ $character->name }}</span>
									@else
									<span>{{ $character->name }},</span>
									@endif
									@endforeach
								</td>
								<td class="col-md-4"><div class="event-source">{{ $record->source }}</div></td>
								<td class="col-md-2 text-center">
										<a href="{{ route('record.show', $record->id) }}" class="btn btn-success btn-sm" role="button"><i class="fas fa-eye"></i></a>
										@if (Auth::check())
										<a href="{{ url('admin/record/'. $record->id . '/edit')}}" class="btn btn-primary btn-sm" role="button"><i class="fas fa-edit"></i></a>

										{!! Form::model($record, ['method' => 'delete', 'route' => ['record.delete', $record->id], 'class' =>'form-inline form-delete']) !!}
										{!! Form::hidden('id', $record->id) !!}
										{!! Form::button('<i class="fas fa-trash" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-sm delete','type' => 'submit', 'name' => 'delete_modal']) !!}
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
					<p>No Records found!</p>
				</div>
				@endif
			</div>
			<div class="text-center">
				{!! $records->appends(\Request::except('page'))->render() !!}
			</div>
		</div>
	</div>
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
		url : '{{ route('record.search') }}',
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
