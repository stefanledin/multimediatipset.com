@extends('master')

@section('content')
	<div class="row">
		<div class="col s12 m8 offset-m2">
			<div class="card orange darken-3">
				<div class="card-content">
					
					@if(count($active_games))
					<span class="card-title">Aktuella tips</span>
					<div class="collection with-header">
						@foreach($active_games as $game)
							<a href="games/{{ $game->id }}" class="orange-text collection-item">
								{{ $game->name }}
								<span class="badge">{{ count($game->predictions) }} tips</span>
							</a>
						@endforeach
					</div>
					@else
					<span class="card-title">Inga pågående tips</span>
					@endif
					<br>
					
					@if(count($finished_games))
					<span class="card-title">Avslutade tips</span>
					<div class="collection with-header">
						@foreach($finished_games as $game)
							<a href="games/{{ $game->id }}" class="orange-text collection-item">
								{{ $game->name }}
								<span class="badge">{{ count($game->predictions) }} tips</span>
							</a>
						@endforeach
					</div>
					@endif

					@if (Auth::check() && Auth::user()->is_admin)
					<a href="{{ route('games.create') }}" class="btn orange">Nytt</a>
					@endif
				</div>
			</div>
		</div>
	</div>
@stop