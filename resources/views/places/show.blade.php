@extends('layouts.main')

@section('content')
	<p>
		<a href="{{ action('PlacesController@index') }}" class="btn btn-default">Back to Places</a>
		<a href="{{ route('places.posts', ['id' => $place->id]) }}" class="btn btn-default">Posts</a>
	</p>
	
	<h1>{{ $place->name }} 
		<a href="{{ action('PlacesController@edit', ['id' => $place->id ]) }}" class="btn btn-primary">Edit</a>

	@if (isset($place->createdBy))
				{{ Form::open(['style' => 'display:inline-block;', 'method' => 'DELETE', 'action' => ['PlacesController@destroy', $place->id], 'onsubmit' => 'return confirm(\'Are you sure you want to delete this place?  This is irreversible.\');']) }}
				<input type="submit" value="Delete" class="btn btn-danger" />
				{{ Form::close() }}
	@endif
				
					</h1>
	<p><strong>Type: </strong> {{ $place->type }}</p>
	<p><strong>Phone: </strong> {{ $place->phone }}</p>
	<p><strong>Website: </strong> {{ $place->website }}</p>
	<p><strong>Reservation Website: </strong> {{ $place->reservationWebsite }}</p>

	@if ($place->reviewStatus)
		<p><strong>Review Status: </strong> {{ $place->reviewStatus  }}</p>
	@endif

	@if (isset($place->createdBy))
		<p>
			<strong>Created by:</strong>
			<a href="{{ action('AccountsController@show', ['id' => $place->createdBy ]) }}" target="_blank">user profile</a>
		</p>
	@endif

	@if (isset($place->categoryId))
		<p>
			<strong>Category:</strong>
			<a href="{{ action('CategoriesController@show', ['id' => $place->categoryId ]) }}" target="_blank">see category</a>
		</p>
	@endif

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