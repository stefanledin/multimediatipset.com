<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Multimediatipset.com™</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
	</head>
	<body>
		<nav>
			<div class="nav-wrapper indigo lighten-1">
				<a href="{{ route('home') }}" class="brand-logo center">multimediatipset.com ™</a>
				<ul id="nav-mobile" class="right">
					@if (!Auth::check())
						<li><a href="/login">Logga in</a></li>
					@else 
						<li><a href="#">{{ Auth::user()->username }}</a></li>
						<li><a href="{{ route('logout') }}">Logga ut</a></li>
					@endif
				</ul>
			</div>
		</nav>

		@section('content')
		@show

		<script src="//code.jquery.com/jquery-latest.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
	</body>
</html>