@extends('layouts.main')

@section('content')

    <h1>Create New Filter</h1>

    {{ Form::open(['route' => 'filters.store']) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        (abbreviated for mobile)
    </div>

    <div class="form-group">
        {{ Form::label('fullName', 'Full Name') }}
        {{ Form::text('fullName', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('values', 'Values') }} (one per line)
        {{ Form::textarea('values', null, ['class' => 'form-control']) }}
    </div>

    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}

    {{ Form::close() }}

@endsection