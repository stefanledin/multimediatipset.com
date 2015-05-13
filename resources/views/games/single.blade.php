@extends('master')

@section('content')
	<div class="row">
		<div class="col s12 m6 offset-m3">
			<div class="card orange darken-3">
				<div class="card-content">
					<div>
						<a href="{{ route('home') }}" class="btn grey darken-2"><i class="mdi-hardware-keyboard-arrow-left left"></i>Tillbaka</a>
					</div>
					<span class="card-title">{{ $game->name }}</span>
					@if($game->predictions)
					<ul class="collection">
						@foreach($game->predictions as $prediction)
							<li class="collection-item">{{ $prediction->prediction }}</li>
						@endforeach
					</ul>
					@endif
					<div class="row">
						<a href="{{ route('games.edit', $game->id) }}" class="btn green col s6">Redigera</a>
						<form action="{{ route('games.destroy', $game->id) }}" method="post">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="submit" class="btn red darken-2 col s6" value="Radera">
						</form>
					</div>
					<div class="row">
						{!! Form::open(['route' => 'predictions.store', 'class' => 'col s12 white']) !!}
							{!! Form::hidden('game_id', $game->id) !!}
							<div class="input-field col s8">
								{!! Form::text('prediction', null, ['placeholder' => 'Resultat']) !!}
							</div>
							<div class="input-field col s4">
								{!! Form::submit('Tippa', ['class' => 'btn orange']) !!}
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop