@extends('layouts.main')

@section('content')

<h1>Login Screen</h1>

{{ Form::open() }}

	<div>
		{{ Form::label('email', 'E-Mail Address') }}
		{{ Form::text('email') }}
	</div>

	<div>
		{{ Form::label('password', 'Password') }}
		{{ Form::password('password') }}
	</div>

		{{ Form::submit('Login') }}

{{ Form::close() }}

@stop