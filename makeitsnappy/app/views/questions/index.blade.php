@extends('layouts.master')

@section('content')
<div id="ask">
	<h1>Ask a Question</h1>

	@if(Auth::check())
		@if($errors->has())
			<p>The following errors have ocurred:</p>
			<ul id="form-errors">
				{{ $errors->first('question', '<li>:message</li>') }}				
			</ul>
		@endif
	

		{{Form::open(array('method' => 'POST', 'url' => '/ask', 'role' => 'form'))}}

		<p>{{ Form::label('question', 'Question') }}<br/>
		   {{ Form::text('question', Input::old('question')) }}

		   {{ Form::submit('Ask a Question') }}
		</p>	

		{{ Form::close() }}
	@else
		<p>Plaese login to ask or answer questions.</p>
	@endif

</div><!-- end ask -->
<div id="questions">
	<h2>Unsolved Questions</h2>

	@if(count($questions) > 0)
		<ul>
			@foreach($questions as $question)
				<li>
					{{ HTML::link('question/'.$question->id, Str::limit($question->question, 35), 
					$question->id) }} by {{ ucfirst($question->user->username) }}
					({{count($question->answers) }} {{ Str::plural('Answer', count($question->answers))}})
				</li>
			@endforeach
		</ul>
		{{ $questions->links() }}
	@else		
		<p>No questions have been asked.</p>
	@endif
</div><!-- end questions -->
@stop