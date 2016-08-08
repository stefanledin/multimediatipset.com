<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Multimediatipset.com™</title>
		<link rel="stylesheet" href="{{ elixir('css/all.css') }}">
  		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>
	<body>
		<nav class="row">
			<div class="nav-wrapper indigo darken-1">
				<div class="col s12">
					<a href="{{ route('home') }}" class="brand-logo">Multimediatipset™</a>
					<ul id="nav-mobile" class="right">
						@if (!Auth::check())
							<li><a href="/login">Logga in</a></li>
						@else 
							<li><a href="/users/{{ Auth::user()->id }}">{{ Auth::user()->username }}</a></li>
							<li><a href="{{ route('logout') }}">Logga ut</a></li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		@section('content')
		@show

		<script type="text/javascript" src="{{ elixir('js/all.js') }}"></script>

		@if(App::environment() != 'local')
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-28191752-3', 'auto');
		ga('send', 'pageview');
		</script>
		@endif

	</body>
</html>
