@extends('layouts.main')

@section('content')
	
	<h1>Edit Address</h1>
	{{ Form::model($address, $form_info) }}
	
	<div class="form-group">
		{{ Form::label('street1', 'Street 1') }}
		{{ Form::text('street1', null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('street2', 'Street 2') }}
		{{ Form::text('street2', null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('city', 'City') }}
		{{ Form::text('city', null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('state', 'State') }}
		{{ Form::text('state', null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('zip', 'Zip') }}
		{{ Form::text('zip', null, ['class' => 'form-control']) }}
	</div>
	<div class="form-inline">
		<div class="form-group">
			{{ Form::label('latitude', 'Latitude') }}
			{{ Form::text('latitude', null, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('longitude', 'Longitude') }}
			{{ Form::text('longitude', null, ['class' => 'form-control']) }}
		</div>
	</div>
	
	<p>{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}</p>
	
	{{ Form::close() }}
	
@endsection