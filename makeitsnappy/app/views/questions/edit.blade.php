@extends('layouts.master')

@section('content')

	<h1>Edit Your Question</h1>
	
	@if($errors->has())
		<ul id="form-errors">
			{{ $errors->first('question', '<li>:message</li>') }}
			{{ $errors->first('solved', '<li>:message</li>') }}				
		</ul>
	@endif


	{{Form::open(array('method' => 'PUT', 'url' => 'question/update', 'role' => 'form'))}}

	<p>{{ Form::label('question', 'Question') }}<br/>
	   {{ Form::text('question', $question->question) }}	   
	</p>	

	<p>{{ Form::label('solved', 'Solved') }}<br/>
		@if($question->solved == 0)
	   		{{ Form::checkbox('solved', 1, false) }}
	   	@elseif($question->solved == 1)	   
	   		{{ Form::checkbox('solved', 1, false) }}
	   	@endif
	</p>
	{{ Form::hidden('question_id', $question->id) }}

	{{ Form::submit('Update') }}

	{{ Form::close() }}

@stop
	