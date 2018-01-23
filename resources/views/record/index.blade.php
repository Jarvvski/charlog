@extends('layouts.app')

@section('content')
@include('components.modal')

<div class="container">
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
						<tbody>
							@foreach ($records as $record)
							<tr>
								<td>{{ $record->amount }}</td>
								<td>{{ $record->title }}</td>
								<td>
									@foreach ($record->characters as $character)
									@if($record->characters->last() === $character)
									<span>{{ $character->name }}</span>
									@else
									<span>{{ $character->name }},</span>
									@endif
									@endforeach
								</td>
								<td class="text-overflow">{{ $record->source }}</td>
								<td>
									<a href="{{ route('record.show', $record->id) }}" class="btn btn-success btn-xs" role="button"><i class="fas fa-inspect"></i></a>
									@if (Auth::check())
									<a href="{{ url('admin/record/'. $record->id . '/edit')}}" class="btn btn-primary btn-xs" role="button"><i class="fas fa-edit"></i></a>

									{!! Form::model($record, ['method' => 'delete', 'route' => ['record.delete', $record->id], 'class' =>'form-inline form-delete']) !!}
									{!! Form::hidden('id', $record->id) !!}
									{!! Form::button('<i class="fas fa-trash" aria-hidden="true"></i>', ['class' => 'btn btn-xs btn-danger delete','type' => 'submit', 'name' => 'delete_modal','style'=>'display:inline-block']) !!}
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
