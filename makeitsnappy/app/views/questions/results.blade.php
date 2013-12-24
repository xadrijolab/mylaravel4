@extends('layouts.master')

@section('content')
	<h1>Search Results</h1>

	@if(count($questions) > 0)
		<ul>
			@foreach($questions as $question)
				<li>
					{{ HTML::link('question', $question->question, $question->id) }}
					by {{ ucfirst($question->user->username) }}
				</li>
			@endforeach
		</ul>

		{{ $questions->links() }}
	@else
		<p>Nothing found, please try a diferent search.</p>
	@endif

@stop