@extends('layouts.main')

@section('content')
	<p><a href="{{ route('places.create') }}" class="btn btn-success">Create Place</a></p>
	
	{{ Form::model($model, ['route' => 'places.index', 'method' => 'GET']) }}
		<div class="form-group form-inline">
			{{ Form::label('q', 'Keyword: ') }}
			{{ Form::text('q', null, ['class' => 'form-control']) }}
			{{ Form::submit('Search', ['class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
		
	@if (count($places))
		<br />
		@if ($view == 'review')
			<h4>Places pending review</h4>
		@else
			<h4>Places matching query</h4>
		@endif
		<br />
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Street</th>
				<th>City</th>
				<th>State</th>
				<th>Zip</th>
			</tr>
		@foreach($places as $place)
			<tr>
				<td><a href="{{ route('places.show', ['id' => $place->id]) }}">{{ $place->name }}</a></td>
				@if (isset($place->address))
					<td>{{ $place->address->street1 }}</td>
					<td>{{ $place->address->city }}</td>
					<td>{{ $place->address->state }}</td>
					<td>{{ $place->address->zip }}</td>
				@else
					<td colspan="4">&nbsp;</td>
				@endif
			</tr>
		@endforeach
		</table>
	@elseif(!empty($places))
		<p>No results matched your search</p>
	@endif
	
@endsection