@extends('layouts.main')

@section('content')
    <form method="get">
        {{ Form::label('search', 'Username: ') }} <input type="text" name="q" id="keyword" value="{{ $keyword }}" onkeyup="updateResults();" /> <span id="keyword-status"></span>
        <input type="submit" class="btn btn-primary" value="Search" />
    </form>

    @if (count($accounts))
        <h1>Search Results</h1>
        <table class="table">
            <tr>
                <th>Name</th>
                {{--<th>Description</th>--}}
                {{--<th>Location</th>--}}
                <th># Followers</th>
                <th># Following</th>
            </tr>
            @foreach($accounts as $account)
                <tr>
                    <td>
                        <a href="{{ route('accounts.show', $account->id) }}">
                        @if($account->profileImageUrl)
                            <img src="{{ $account->profileImageUrl }}" width="50" />
                        @endif
                        {{ $account->name }}
                        </a>
                    </td>
{{--                    <td>{{ $account->description }}</td>--}}
{{--                    <td>{{ $account->location }}</td>--}}
                    <td>{{ number_format($account->stats->numFollowers) }}</td>
                    <td>{{ number_format($account->stats->numFollowing) }}</td>
                </tr>
            @endforeach
        </table>
    @else
        @unless (empty($keyword))
            No results available
        @endunless
    @endif
@endsection