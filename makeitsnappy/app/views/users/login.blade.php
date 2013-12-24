@extends('layouts.master')

@section('content')
	<h1>Login</h1>

	{{Form::open(array('method' => 'POST', 'url' => '/login', 'role' => 'form'))}}

	<p>{{ Form::label('username', 'Username') }}<br/>
	   {{ Form::text('username', Input::old('username')) }}</p>

	<p>{{ Form::label('password', 'Password') }}<br/>
	   {{ Form::password('password') }}</p>

	<p>{{ Form::submit('Login') }}</p>

	{{ Form::close() }}

@stop