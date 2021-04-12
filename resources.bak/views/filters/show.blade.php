@extends('layouts.main')

@section('content')
    <p><a href="{{ route('filters.index') }}">Back to Filters</a></p>

    <h1>
        @if (isset($filter->fullName))
            {{ $filter->name }}
        @else
            {{ $filter->name }}
        @endif
        <a href="{{ route('filters.edit', ['id' => $filter->id ]) }}" class="btn btn-primary">Edit</a>
    </h1>

    @if (isset($filter->fullName))
    <p><strong>Full:</strong> {{ $filter->fullName }}</p>
    @endif

    <p><strong>Name:</strong> {{ $filter->name }}</p>

    <p><strong>Slug:</strong> {{ $filter->slug }}</p>

    <p><strong>Values: </strong><br />
        @if (count($filter->values) > 0)
            <ul>
                @foreach($filter->values as $value)
                    <li>{{ $value }}</li>
                @endforeach
            </ul>
        @else
                No values
        @endif
    </p>

@endsection