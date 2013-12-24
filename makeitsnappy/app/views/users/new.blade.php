@extends('layouts.master')

@section('content')
	<h1>Register</h1>

	@if($errors->has())
		<p>The following errors have ocurred:</p>
		<ul id="form-errors">
			{{ $errors->first('username', '<li>:message</li>') }}
			{{ $errors->first('password', '<li>:message</li>') }}
			{{ $errors->first('password_confirmation', '<li>:message</li>') }}
		</ul>
	@endif

	{{Form::open(array('method' => 'POST', 'url' => '/register', 'role' => 'form'))}}


	<p>{{ Form::label('username', 'Username') }}<br/>
	   {{ Form::text('username', Input::old('username')) }}</p>

	<p>{{ Form::label('password', 'Password') }}<br/>
	   {{ Form::password('password') }}</p>

	<p>{{ Form::label('password_confirmation', 'Confirm Password') }}<br/>
	   {{ Form::password('password_confirmation') }}</p>

	<p>{{ Form::submit('Register') }}</p>

	{{ Form::close() }}
@stop