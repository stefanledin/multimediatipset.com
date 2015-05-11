@extends('master')

@section('content')
	<div class="row">
		<div class="col s12 m6 offset-m3">
			<div class="card orange darken-3">
				<div class="card-content">
					<span class="card-title">{{ $game->name }}</span>
					<div class="row">
						<form class="col s12 white">
							<div class="input-field col s6">
								<input placeholder="Placeholder" id="first_name" type="text" class="validate">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop