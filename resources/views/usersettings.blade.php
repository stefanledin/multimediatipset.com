@extends('master')

@section('content')

	<div class="row">
		<div class="col s12 m6 offset-m3">
			<h3>Hej {{ $user->username }}!</h3>
			<div class="row"> 
			{!! Form::open(['action' => ['UsersController@update', $user->id]]) !!}

				<div class="input-field col s12"> 
					{!! Form::text('username', $user->username, ['id' => 'username']) !!}
					{!! Form::label('username', 'Anvädarnamn') !!}
				</div>

				{!! Form::submit('Spara', ['class' => 'btn orange']) !!}

			{!! Form::close() !!}
			</div>
		</div>
	</div>
	

@stop