@extends('layouts.main')

@section('content')

    <h1>Flagged Content</h1>

    <table class="table">
        <tr>
            <th>Date</th>
            <th>Object Type</th>
            <th>Object ID</th>
            <th>Flagged By</th>
            <th>Status</th>
            <th>&nbsp;</th>
            {{--<th>Reviews</th>--}}
        </tr>
        @foreach($flags as $flag)
            <tr>
                <td>{{ (new \Carbon\Carbon($flag->created))->format('m/d/Y H:iA') }}</td>
                <td>{{ $flag->objectType }}</td>
                <td>{{ $flag->objectId }}</td>
                <td>
                    @if(isset($flag->flagger))
                        {{ $flag->flagger->name }}
                    @else
                        Unknown
                    @endif
                </td>
                <td>{{ $flag->status }}</td>
                <td>
                    @if ($flag->objectType == 'post')
                        <a href="{{ route('posts.show', ['id' => $flag->objectId]) }}" class="btn btn-default">View Post</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    @include('partials/pager', [
        'offset' => $offset,
        'limit' => $limit,
        'total' => $total,
        'link' => route('flags.index')
    ])

@endsection