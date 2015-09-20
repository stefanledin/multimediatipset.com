<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Multimediatipset.com™</title>
		<link rel="stylesheet" href="/css/all.css">
		<link async href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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

		<script type="text/javascript" src="/js/all.js"></script>
	</body>
</html>