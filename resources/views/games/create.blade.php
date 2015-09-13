@extends('master')

@section('content')
	<div class="row">
		<div class="col s12 m6 offset-m3">
			<div class="card orange darken-3">
				<div class="card-content">
					<div>
						<a href="{{ route('home') }}" class="btn grey darken-2"><i class="mdi-hardware-keyboard-arrow-left left"></i>Tillbaka</a>
					</div>
					<span class="card-title">Nytt tips</span>
					<div class="row">
						<form action="{{ route('games.store')  }}" method="post" class="col s12 white">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="input-field col s12">
								<input placeholder="Namn" id="name" name="name" type="text">
							</div>
                            <div class="input-field col s12">
                                <input type="number" placeholder="Pris" id="price" name="price">
                            </div>
                            <div class="input-field col s12">
                                <select name="status" class="browser-default">
                                    <option disabled selected>Typ av tips</option>
                                    <option value="">Tabellplaceringar</option>
                                    <option value="">Resultat</option>
                                </select>
                            </div>
                            <div class="input-field col s12">
                                <select name="status" class="browser-default">
                                    <option disabled selected>Status</option>
                                    <option value="open">Öppen</option>
                                    <option value="closed">Stängd</option>
                                    <option value="finished">Avslutad</option>
                                </select>
                            </div>
							<div class="input-field col s12">
								<input type="submit" class="btn orange" value="Skapa">
                                <br/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop