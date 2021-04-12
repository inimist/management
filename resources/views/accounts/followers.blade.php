@extends('layouts.main')

@section('content')
    <p><a href="{{ route('accounts.show', ['id' => $account->id]) }}" class="btn btn-default">Back to User</a></p>
    <h1>{{ $title }}</h1>

    <table class="table">
    @foreach($follows as $follower)
        <tr>
            <td>
                <a href="{{ route('accounts.show', ['id' => $follower->id]) }}">
                    <img src="{{ $follower->profileImageUrl }}" width="50" border="0" />
                    {{ $follower->name }}</a>
            </td>
        </tr>
    @endforeach
    </table>
@endsection