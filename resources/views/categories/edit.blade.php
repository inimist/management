@extends('layouts.main')

@section('content')

	<p><a href="{{ route('categories.show', ['id' => $category->id]) }}">Back to Overview</a></p>

	<h1>Editing {{ $category->name }}</h1>
	
	{{ Form::model($category, array('action' => array('CategoriesController@update', $category->id), 'method' => 'PUT')) }}

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				{{ Form::label('enable', 'Enabled') }}
				{{ Form::checkbox('enable', null) }}
			</div>

			<div class="form-group">
				{{ Form::label('name', 'Name') }} (searchable)
				{{ Form::text('name', null, ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('parentId', 'Parent') }}
				{{ Form::select('parentId', $categories, null, ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('type', 'Type') }}
				{{ Form::select('type', $types, null, ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('displayName', 'Display Name') }} (not searchable)
				{{ Form::text('displayName', null, ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('pluralName', 'Plural Name') }} (searchable)
				{{ Form::text('pluralName', null, ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('aliases', 'Aliases') }} (one per line, searchable)
				{{ Form::textarea('aliases', $aliases, ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('searchMetaData', 'Search Meta Data') }}
				{{ Form::text('searchMetaData', null, ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('flags', 'Featured') }} (aka &quot;Popular&quot;)
				{{ Form::checkbox('featured', null, $featured) }}
			</div>

			<div class="form-group">
				{{ Form::label('flags', 'Exclude Feed Search') }}
				{{ Form::checkbox('excludeFeedSearch', null, $exclude_feed_search) }}
			</div>

			{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
		</div>
		<div class="col-md-8">
			<h2>Type Info</h2>
			@include('categories.partials.typedescription', array('type_grid' => $type_grid))
		</div>
	</div>

	{{ Form::close() }}

@endsection