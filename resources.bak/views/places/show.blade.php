@extends('layouts.main')

@section('content')
	<p>
		<a href="{{ action('PlacesController@index') }}" class="btn btn-default">Back to Places</a>
		<a href="{{ route('places.posts', ['id' => $place->id]) }}" class="btn btn-default">Posts</a>
	</p>
	
	<h1>{{ $place->name }} 
		<a href="{{ action('PlacesController@edit', ['id' => $place->id ]) }}" class="btn btn-primary">Edit</a>
	</h1>
	<p><strong>Type: </strong> {{ $place->type }}</p>
	<p><strong>Phone: </strong> {{ $place->phone }}</p>
	<p><strong>Website: </strong> {{ $place->website }}</p>
	<p><strong>Reservation Website: </strong> {{ $place->reservationWebsite }}</p>

	<h2>Address:</h2>
	@if (isset($place->address))
		<div class="list-group">
			<div class="list-group-item">
				<p>{{ $place->address->street1 }}<br />
				@unless (empty($place->address->street2))
					{{ $place->address->street2 }}<br />
				@endunless
				{{ $place->address->city }}, {{ $place->address->state }} {{ isset($place->address->zip) ? $place->address->zip : '' }}</p>
			</div>
		</div>
	@else
		<p>None</p>
	@endif
	
@endsection