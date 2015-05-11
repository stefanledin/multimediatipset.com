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
							<a href="games/{{ $game->id }}" class="orange-text collection-item">{{ $game->name }}</a>
						@endforeach
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@stop