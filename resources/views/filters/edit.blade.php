@extends('layouts.main')

@section('content')

    <h1>Editing
        @if (isset($filter->fullName))
            {{ $filter->fullName }}
        @else
            {{ $filter->name }}
        @endif
    </h1>

    {{ Form::model($filter, array('route' => array('filters.update', $filter->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }} (abbreviated for mobile)
        {{ Form::text('name', null, ['class' => 'form-control']) }}
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