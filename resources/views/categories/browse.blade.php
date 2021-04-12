@extends('layouts.main')

@section('content')
	<p><a href="{{ route('categories.index') }}" class="btn btn-default">Back to Search</a> <a href="{{ route('categories.create') }}@if($category)?parentid={{$category->id}}@endif" class="btn btn-success">Create Category</a></p>

	@if ($category)

		<p><a href="{{ route('categories.browse') }}" class="badge">Root</a>
		@if (isset($category->hierarchy))
			@foreach($category->hierarchy as $parent)
			<i class="glyphicon glyphicon-chevron-right"></i> <a href="{{ route('categories.browse') }}?category={{ $parent->id }}" class="badge">{{ $parent->name}}</a>
			@endforeach
		@else

		@endif
		</p>

		<h1>@if($category->enable === false)<span class="text-danger">@endif{{ $category->name }} @if ($category->enable === false)</span> (disabled)@endif
			<a href="{{ route('categories.edit', ['id' => $category->id]) }}" class="btn btn-primary">Edit</a>
			<a href="{{ route('categories.show', ['id' => $category->id]) }}" class="btn btn-primary">View</a>
			<a href="{{ route('categories.posts', ['id' => $category->id]) }}" class="btn btn-default">Posts</a>
			@unless (count($categories))
				{{ Form::open(['style' => 'display:inline-block;', 'method' => 'DELETE', 'action' => ['CategoriesController@destroy', $category->id], 'onsubmit' => 'return confirm(\'Are you sure you want to delete this category?  This is irreversible.\');']) }}
				<input type="submit" value="Delete" class="btn btn-danger" />
				{{ Form::close() }}
			@endunless
		</h1>
		@if (count($categories))
			<span class="text-danger" style="font-size:1.2rem;font-weight:normal;">This category cannot be deleted because it has sub-categories.</span>
		@endif
	@endif

	@if (count($categories))
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Display Name</th>
				<th>Type</th>
				<th>&nbsp;</th>
			</tr>
		@foreach($categories as $category)
			<tr>
				<td @if ($category->enable === false) class="bg-danger" style="text-decoration:line-through"@endif><a href="{{ route('categories.browse') }}?category={{ $category->id }}">{{ $category->name }}</a></td>
				<td @if ($category->enable === false) class="bg-danger" style="text-decoration:line-through"@endif><a href="{{ route('categories.browse') }}?category={{ $category->id }}">{{ $category->displayName }}</a></td>
				<td @if ($category->enable === false) class="bg-danger" style="text-decoration:line-through"@endif>{{ $category->type or '' }}</td>
				<td @if ($category->enable === false) class="bg-danger"@endif>
					{{--<a href="{{ route('categories.show', ['id' => $category->id ]) }}" class="btn btn-primary">View</a>--}}
					<a href="{{ route('categories.edit', ['id' => $category->id ]) }}" class="btn btn-primary">Edit</a>
				</td>
			</tr>
		@endforeach
		</table>
	@else
		<p>No sub categories.</p>
	@endif
	
@endsection