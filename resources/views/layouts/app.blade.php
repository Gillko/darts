<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Darts') }}</title>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

	<!-- Styles -->
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-expand-lg">
		<a class="navbar-brand navbar-brand-d" href="{{ url('/') }}">
			Darts
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarText">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="{{ url('/groups') }}">Groups</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ url('/players') }}">Players</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ url('/games') }}">Games</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ url('/scores') }}">Scores</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ url('/leaderboard') }}">Leaderboard</a>
				</li>
			</ul>
			<span>
				@guest
				<a href="{{ route('login') }}">
					<i class="fa fa-lock fa-2x" aria-hidden="true"></i>
				</a>
				@else
				<ul class="navbar-nav mr-auto">
					<li class="nav-item nav-item-user-name">
						{{ Auth::user()->name }}
					</li>
					<li class="nav-item">
						<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							<i class="fa fa-unlock fa-2x" aria-hidden="true"></i>
						</a>
					</li>
				</ul>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
				@endguest
			</span>
		</div>
	</nav>
	<div id="app">
		<div class="container">

		</div>

		<main class="py-4">
			@yield('content')
		</main>
	</div>
</body>
</html>
