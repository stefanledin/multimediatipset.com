@extends('master')

@section('content')
	<div class="row">
		<div class="col s12 m6 offset-m3">
			<div class="card orange darken-3">
				<div class="card-content">
					<span class="card-title">Aktuella tips</span>
					@if($active_games)
					<div class="collection with-header">
						@foreach($active_games as $game)
							<a href="games/{{ $game->id }}" class="orange-text collection-item">
								{{ $game->name }}
								<span class="badge">{{ count($game->predictions) }} tips</span>
							</a>
						@endforeach
					</div>
					@endif
					<a href="{{ route('games.create') }}" class="btn orange">Nytt</a>
				</div>
			</div>
		</div>
	</div>
@stop