@extends('layouts.main')

@section('content')
	
	<h1>Editing {{ $place->name }}</h1>
	
	{{ Form::model($place, array('action' => array('PlacesController@update', $place->id), 'method' => 'PUT')) }}
	
	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', $place->name, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('type', 'Type') }}
		{{ Form::select('type', $types, $place->type, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('type', 'Review Status') }}
		{{ Form::select('reviewStatus', $reviewStatuses, $place->reviewStatus, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('street1', 'Street 1') }}
		{{ Form::text('street1', $place->address->street1, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('street2', 'Street 2') }}
		{{ Form::text('street2', $place->address->street2, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('city', 'City') }}
		{{ Form::text('city', $place->address->city, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('state', 'State') }}
		{{ Form::text('state', $place->address->state, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('zip', 'Zip') }}
		{{ Form::text('zip', $place->address->zip, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('phone', 'Phone') }}
		{{ Form::text('phone', $place->phone, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('website', 'Website') }}
		{{ Form::text('website', $place->website, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('reservationWebsite', 'Reservation Website') }}
		{{ Form::text('reservationWebsite', $place->reservationWebsite, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('searchMetaData', 'Search Meta Data') }}
		{{ Form::text('searchMetaData', isset($place->searchMetaData) ? $place->searchMetaData : '', ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('categoryId', 'Category Id') }}
		{{ Form::text('categoryId', isset($place->categoryId) ? $place->categoryId : '', ['class' => 'form-control']) }}
	</div>
	<div class="form-inline">
		<div class="form-group">
			{{ Form::label('latitude', 'Latitude') }}
			{{ Form::text('latitude', (isset($place->address->coordinates->latitude) ? $place->address->coordinates->latitude : ''), ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('longitude', 'Longitude') }}
			{{ Form::text('longitude', (isset($place->address->coordinates->longitude) ? $place->address->coordinates->longitude : ''), ['class' => 'form-control']) }}
		</div>
	</div>

	{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
	
	{{ Form::close() }}
	
@endsection