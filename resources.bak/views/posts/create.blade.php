@extends('layouts.main')

@section('content')
	
	<h1>Create New Post</h1>
	
	{{ Form::open(['route' => 'posts.store', 'files' => 'true']) }}
	
	<div class="form-group">
		{{ Form::label('description', 'Description') }}
		{{ Form::text('description', $post['description'], ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('file', 'File') }}
		{{ Form::file('file', '', ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('categoryId', 'Category Id') }}
		{{ Form::text('categoryId', $post['categoryId'], ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('userId', 'User Id') }}
		{{ Form::text('userId', $post['userId'], ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('placeId', 'Place Id') }}
		{{ Form::text('placeId', $post['placeId'], ['class' => 'form-control']) }}
	</div>

	{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
	
	{{ Form::close() }}
	
@endsection