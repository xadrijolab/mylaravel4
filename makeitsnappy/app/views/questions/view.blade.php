@extends('layouts.master')

@section('content')

	<h1>{{ ucfirst($question->user->username) }} asks:</h1>

	<p>{{ e($question->question) }}</p>

	<div id="answers">
		<h2>Answers</h2>

		@if(count($question->answers) > 0)
			<ul>
				@foreach($question->answers as $answer)
					<li>{{ e($answer->answer) }} - by {{ ucfirst($answer->user->username) }}</li>
				@endforeach
			</ul>
		@else
			<p>This question has not been answered yet.</p>
		@endif
	</div><!-- end answers -->

	<div id="post-answer">
		<h2>Answer this Question</h2>

		@if(!Auth::check())
			<p>Please login to post an answer for this question.</p>
		@else
			@if($errors->has())
			<ul id="form-errors">
				{{ $errors->first('answer', '<li>:message</li>') }}
			</ul>
			@endif

			{{Form::open(array('method' => 'POST', 'url' => 'answer', 'role' => 'form'))}}

			<p>
				{{ Form::label('answer', 'Answer') }}<br/>
			    {{ Form::text('answer', Input::old('answer')) }}

			    {{ Form::submit('Post Answer') }}	   
			</p>	

			{{ Form::hidden('question_id', $question->id) }}			

			{{ Form::close() }}
		@endif
	</div>

@stop