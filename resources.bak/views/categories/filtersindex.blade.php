@extends('layouts.main')

@section('content')

    <p><a href="{{ route('categories.show', ['id' => $category->id]) }}" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Back to Details</a></p>

    <h1>{{ $category->name }}</h1>

    @if (count($filters))

        <h2>Current Filters</h2>

        <table class="table">
            <tr>
                <th>Full Name</th>
                <th>Name</th>
                <th>&nbsp;</th>
            </tr>
            @foreach($filters as $filter)
                <tr>
                    <td>{{ $filter->fullName }}</td>
                    <td>{{ $filter->name }}</td>
                    <td><a href="{{ route('categories.removeFilter', ['categoryId' => $category->id, 'filterId' => $filter->id]) }}" class="btn btn-danger">Remove</a></td>
                </tr>
            @endforeach
        </table>

    @endif

    @if (count($available_filters))

        <h2>Available Filters</h2>

        <table class="table">
            <tr>
                <th>Full Name</th>
                <th>Name</th>
                <th>&nbsp;</th>
            </tr>
            @foreach($available_filters as $filter)
                <tr>
                    <td>{{ $filter->fullName }}</td>
                    <td>{{ $filter->name }}</td>
                    <td><a href="{{ route('categories.addFilter', ['categoryId' => $category->id, 'filterId' => $filter->id]) }}" class="btn btn-success">Add</a></td>
                </tr>
            @endforeach
        </table>

    @endif

@endsection