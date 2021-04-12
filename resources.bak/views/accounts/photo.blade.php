@extends('layouts.main')

@section('content')

    <h1>Change Account Photo</h1>
    <p>
        <a class="btn btn-default" href="{{ route('accounts.show', ['id' => $account->id])  }}">Back to user profile</a>
    </p>

    @if (isset($message))
        <p class="alert alert-success">{{ $message }}</p>
    @endif

    {{ Form::open(['files' => 'true']) }}

    @if (isset($account) && isset($account->profileImageUrl))
        <div class="form-group">
            <label>Current photo</label>
            <div>
                <img src="{{ $account->profileImageUrl  }}" />
            </div>
        </div>
    @endif

    <div class="form-group">
        {{ Form::label('file', 'New File') }}
        {{ Form::file('file', '', ['class' => 'form-control']) }}
    </div>

    {{ Form::submit('Update photo', ['class' => 'btn btn-primary']) }}

    {{ Form::close() }}

@endsection
