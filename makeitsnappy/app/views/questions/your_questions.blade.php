@extends('layouts.master')

@section('content')

	@if($errors->has())
		<ul id="form-errors">
			{{ $errors->first('question', '<li>:message</li>') }}						
		</ul>
	@endif

	<h1>{{ ucfirst($username) }} Questions</h1>

	@if(count($questions) > 0)
		<ul>
			@foreach($questions as $question)
				<li>
					{{ Str::limit(e($question->question), 40) }} -
					{{ ($question->solved) ? ("(Solved) - ") : ("") }}
					{{ HTML::link('question/'.$question->id.'/edit', 'Edit', $question->id) }} -
					{{ HTML::link('question/'.$question->id, 'View', $question->id) }}
				</li>
			@endforeach
		</ul>
		{{ $questions->links() }}
	@else
		<p>You've not posted any questions yet.</p>
	@endif

@stop