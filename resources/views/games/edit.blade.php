@extends('master')

@section('content')
	<div class="row">
		<div class="col s12 m6 offset-m3">
			<div class="card orange darken-3">
				<div class="card-content">
					<div>
						<a href="{{ route('home') }}" class="btn grey darken-2"><i class="mdi-hardware-keyboard-arrow-left left"></i>Tillbaka</a>
					</div>
					<span class="card-title">Redigera tips</span>
					<div class="row">
						{!! Form::model($game, ['route' => ['games.update', $game->id], 'method' => 'put', 'class' => 'col s12 white']) !!}
							<div class="input-field col s12">
								{!! Form::text('name') !!}
							</div>
                            <div class="input-field col s12">
                            	{!! Form::number('price') !!}
                            </div>
                            <div class="input-field col s12">
                            	{!! Form::select('status', $statuses, $game->status, ['class' => 'browser-default']) !!}
                            </div>
							<div class="input-field col s12">
								{!! Form::submit('Spara', ['class' => 'btn orange']) !!}
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop