@extends('layouts.main')

@section('content')
    <p>
        <a href="{{ route('accounts.show', ['id' => $claim->profile->userId]) }}" class="btn btn-default">
            Back
        </a>
    </p>
    @if(empty($claim))  
        <table class="table">
            <th>No results</th>
        </table>
    @else
        <table class="table">
            <p><strong> Full name</strong> {{ $claim->claimer->name }}</p>
            <p><strong> Business Name</strong> {{ $claim->place->name }}</p>
            <p><strong> Instagram handle</strong> {{ $claim->claimer->insta }}</p>
            <p><strong> Email</strong> {{ $claim->claimer->email }}</p>
            <p><strong> Place</strong> {{ $claim->place->name }}</p>
            <p><strong> Status</strong> {{ $claim->status }}</p>
            <p>{{ Form::open(['route' => ['accounts.approve'], 'method' => 'post', 'onclick' => 'return confirm(\'Are you sure you want to Approve this user accounts?\');']) }}
                <input type="submit" value="Approve" class="btn btn-success" />
                <input type="hidden" name="status" value="Approved"/>
                <input type="hidden" name="email" value="{{ $claim->claimer->email }}"/>
                <input type="hidden" name="profileid" value="{{ $claim->profile->userId }}"/>
                <input type="hidden" name="token" value="{{ md5(uniqid(rand(), true)) }}"/>
            {{ Form::close() }} </p><p>
            {{ Form::open(['route' => ['accounts.approve'], 'method' => 'post', 'onclick' => 'return confirm(\'Are you sure you want to Decline this user accounts?\');']) }}
                <input type="submit" value="Declined" class="btn btn-danger" />
                <input type="hidden" name="status" value="Declined"/>
                <input type="hidden" name="email" value="{{ $claim->claimer->email }}"/>
                <input type="hidden" name="profileid" value="{{ $claim->profile->userId }}"/>
                <input type="hidden" name="token" value="{{ md5(uniqid(rand(), true))  }}"/>
            {{ Form::close() }} </p>
        </table>  
    @endif
@endsection