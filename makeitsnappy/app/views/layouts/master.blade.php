<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>
	{{ HTML::style('/css/main.css'); }}
	{{ HTML::script('js/application.js') }}
</head>
<body>
	<div id="container">
		<div id="header">
			{{ HTML::link('/', 'Make It Snappy Q&A'); }}

			<div id="searchbar">
				{{ Form::open(array('method'=>'POST', 'url' => '/search', 'role' => 'form')) }}
					{{ Form::text('keyword', 'Search', array('id'=>'keyword')) }}
		   			{{ Form::submit('Search') }}
				{{ Form::close() }}
			</div><!-- end searchbar -->
		</div><!-- end header -->

		<div id="nav">
			<ul>
				<li>{{ HTML::link('/', 'Home'); }}</li>
				@if(!Auth::check())
					<li>{{ HTML::link('/register', 'Register'); }}</li>
					<li>{{ HTML::link('/login', 'Login'); }}</li>
				@else
					<li>{{ HTML::link('your-questions', "Your Q's") }}</li>
					<li>{{ HTML::link('logout', 'Logout ('.Auth::user()->username.')'); }}</li>
				@endif
			</ul>
		</div><!-- end nav -->

		<div id="content">
			@if(Session::has('message'))
				<p id="message">{{ Session::get('message') }}</p>
			@endif
			@yield('content')
		</div><!-- end content -->

		<div id="footer">
			&copy; Make It Snappy Q&A {{ date('Y') }}
		</div><!-- end footer -->

	</div><!-- end container -->

</body>
</html>