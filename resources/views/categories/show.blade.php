@extends('layouts.main')

@section('head')
	<script type="text/javascript">
	var updating = {};

	function updateCategoryFilter(btn) {
		var $btn = $(btn);
		if (updating[$btn]) return;

		updating[$btn] = true;
		$btn.text('Updating...');
		var $form = $btn.parents('form');
		var $values = $form.find('.filter-value');
		$btn.text('Updating');

		var values = [];
		$values.filter(function() { return ($(this).is(':checked')); }).map(function() {
			values.push($(this).val());
		});
console.log('values', values);
		$.ajax({
			url: $form.attr('action'),
			method: $form.attr('method'),
			data: {
				values: values,
				_token: '{{ csrf_token() }}'
			},
//			dataType: 'json',
			error: function(data) {
				delete updating[$btn];

				console.log('Failed: ', data);
				$btn.text('Failed, Try Again');
			},
			success: function(data) {
				console.log('Success: ', data);
				$btn.text('Done');
				setTimeout(function() {
					$btn.text('Update');
					delete updating[$btn];
				}, 1000);
			}
		});
	}
	</script>
@endsection
@section('content')

	<p><a href="{{ route('categories.browse') }}" class="badge">Root</a>
	@if (isset($category->hierarchy))
		@foreach($category->hierarchy as $parent)
		<i class="glyphicon glyphicon-chevron-right"></i> <a href="{{ route('categories.browse', ['category' => $parent->id]) }}" class="badge">{{ $parent->name }}</a>
		@endforeach
	@endif
	</p>

	<h1>
		@if($category->enable === false)<span class="text-danger">@endif{{ $category->name }} @if($category->enable === false)</span> (disabled)@endif
		<a href="{{ route('categories.edit', ['id' => $category->id ]) }}" class="btn btn-primary">Edit</a>
			<a href="{{ route('categories.posts', ['id' => $category->id]) }}" class="btn btn-default">Posts</a>
	</h1>

	@if (isset($category->type))
		<p><strong>Type:</strong> {{ $category->type }}</p>
	@endif


	<h2>
		@if (isset($category->type) && $category->type == 'Virtual')
			Filter Values
		@else
			Filters
		@endif

		@if (isset($category->type) && $category->type == 'Primary')
			<a href="{{ route('categories.filtersIndex', ['categoryId' => $category->id]) }}" class="btn btn-info">Manage</a>
		@endif
	</h2>

	@if (isset($category->filters) && count($category->filters) > 0)
		<ul>
			@foreach($category->filters as $filter)
				<li><strong>{{ $filter->name }}</strong>
					@if ($category->type && $category->type != 'Primary')
						<br />
						<form action="{{ route('categories.setFilterValue', ['categoryId' => $category->id, 'filterId' => $filter->id]) }}" method="post">
						@foreach($filter->possibleValues as $value)
							<label><input type="checkbox" name="values[]" class="filter-value" value="{{ $value }}" @if (in_array($value, $filter->values)) checked="true" @endif /> {{ $value }}</label><br />
						@endforeach
						<input type="submit" class="btn btn-info" value="Update" />
						</form>
					@endif
				</li>
			@endforeach
		</ul>

	@endif

@endsection