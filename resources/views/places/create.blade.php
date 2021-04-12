@extends('layouts.main')

@section('content')
	
	<h1>Create New Place</h1>
	
	{{ Form::open(['route' => 'places.store']) }}
	
	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', '', ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('type', 'Type') }}
		{{ Form::select('type', $types, null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('type', 'Review Status') }}
		{{ Form::select('reviewStatus', $reviewStatuses, 'Approved', ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('street1', 'Street 1') }}
		{{ Form::text('street1', '', ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('street2', 'Street 2') }}
		{{ Form::text('street2', '', ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('city', 'City') }}
		{{ Form::text('city', '', ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('state', 'State') }}
		{{ Form::text('state', '', ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('zip', 'Zip') }}
		{{ Form::text('zip', '', ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('phone', 'Phone') }}
		{{ Form::text('phone', '', ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('website', 'Website') }}
		{{ Form::text('website', '', ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('reservationWebsite', 'Reservation Website') }}
		{{ Form::text('reservationWebsite', '', ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('searchMetaData', 'Search Meta Data') }}
		{{ Form::text('searchMetaData', '', ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('categoryId', 'Category Id') }}
		{{ Form::text('categoryId', isset($place->categoryId) ? $place->categoryId : '', ['class' => 'form-control']) }}
	</div>

	<div class="form-inline">
		<div class="form-group">
			{{ Form::label('latitude', 'Latitude') }}
			{{ Form::text('latitude', '', ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('longitude', 'Longitude') }}
			{{ Form::text('longitude', '', ['class' => 'form-control']) }}
		</div>
	</div>

	{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
	
	{{ Form::close() }}
	
@endsection