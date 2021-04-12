@extends('layouts.main')

@section('content')
    <p><a href="{{ route('filters.create') }}" class="btn btn-success">Create Filter</a></p>

    @if (count($filters))
        <table class="table">
        @foreach($filters as $filter)
            <tr><td>
                <a href="{{ route('filters.show', ['id' => $filter->id]) }}">
                    @if (isset($filter->fullName))
                        {{ $filter->fullName }}
                    @else
                        {{ $filter->name }}
                    @endif
                </a>
            </td></tr>
        @endforeach
        </table>
    @elseif(!empty($filters))
        <p>There are not currently any filters configured.</p>
    @endif

@endsection