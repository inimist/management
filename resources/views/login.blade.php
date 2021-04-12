@extends('layouts.main')

@section('content')

	<h1>Login</h1>

	@if (isset($login_error))
		<div class="alert alert-warning">{{ $login_error }}</div>
	@endif

	{{ Form::open() }}
	{{ Form::token() }}

	<div class="form-group">
		{{ Form::label('email', 'Email: ') }}
		{{ Form::text('email', null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
		{{ Form::label('password', 'Password: ') }}
		{{ Form::password('password', null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
		{{ Form::submit('Login') }}
	</div>

	{{ Form::close() }}
@endsection