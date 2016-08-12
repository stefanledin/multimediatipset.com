@extends('master')

@section('content')
	<div class="row">
		<div class="col s12 m8 offset-m2">
			<div class="card orange darken-3">
				<div class="card-content">
					<div class="collection with-header">
						<div class="collection-header">
							<span class="card-title">Aktuella tips</span>
						</div>
						@if(count($active_games))
							@foreach($active_games as $game)
								<a href="games/{{ $game->id }}" class="collection-item orange-text">
									{{ $game->name }}
									<span class="badge">{{ count($game->predictions) }} tips</span>
								</a>
							@endforeach
						@else
							<div class="collection-item">
								<span>Inga pågående tips</span>
							</div>
						@endif
					</div>
					
					@if(count($finished_games))
						<div class="collection with-header">
							<div class="collection-header">
								<span class="card-title">Avslutade tips</span>
							</div>
							@if(count($finished_games))
								@foreach($finished_games as $game)
									<a href="games/{{ $game->id }}" class="collection-item orange-text">
										{{ $game->name }}
										<span class="badge">{{ count($game->predictions) }} tips</span>
									</a>
								@endforeach
							@else
								<div class="collection-item">
									<span>Inga pågående tips</span>
								</div>
							@endif
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