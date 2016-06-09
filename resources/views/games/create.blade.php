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
						<form id="create-game" action="{{ route('games.store')  }}" method="post" class="col s12 white">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="input-field col s12">
								<input placeholder="Namn" id="name" name="name" type="text">
							</div>
                            <div class="input-field col s12">
                                <input type="number" placeholder="Pris" id="price" name="price">
                            </div>
                            <div class="input-field col s12">
                                <select v-model="gameType" v-on="change: changeGameType" name="game-type" class="browser-default">
                                    <option disabled selected>Typ av tips</option>
                                    <option value="LeagueTable">Tabellplaceringar</option>
                                    <option value="Results">1-X-2</option>
                                    <option value="Score">Mål/poäng</option>
                                    <option value="Series">Matchserier</option>
                                </select>
                            </div>
                            
                            <div class="input-field col s12">
                                <table class="bordered striped responsive-table">
                                    <thead>
                                        <tr>
                                            <th>Match</th>
                                            <th>1</th>
                                            <th>X</th>
                                            <th>2</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-repeat="teams">
                                            <td>
                                                <input type="text" name="game-data[matches][@{{$index}}][match]" value="@{{$value}}">
                                            </td>
                                            <td>
                                                <input type="radio" name="game-data[matches][@{{$index}}][alternatives][1]">
                                                <label for=""></label>
                                            </td>
                                            <td>
                                                <input type="radio" name="game-data[matches][@{{$index}}][alternatives][X]">
                                                <label for=""></label>
                                            </td>
                                            <td>
                                                <input type="radio" name="game-data[matches][@{{$index}}][alternatives][2]">
                                                <label for=""></label>
                                            </td>
                                            <td><button v-on="click: removeTeam($index, $event)" class="waves-effect btn right"><i class="material-icons small">delete</i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input v-model="newTeam" type="text" placeholder="Lägg till match">
                                <button class="btn" v-on="click: addTeam">Lägg till</button>
                            </div>
                            
                            <div v-if="gameType === 'LeagueTable'" class="input-field col s12">
                            	<table class="bordered striped responsive-table">
                            		<thead>
                            			<tr>
                            				<th>Lag</th>
                            				<th>&nbsp;</th>
                            			</tr>
                            		</thead>
                            		<tbody>
                            			<tr v-repeat="teams">
                            				<td><input type="text" name="game-data[]" value="@{{$value}}"></td>
                            				<td><button v-on="click: removeTeam($index, $event)" class="waves-effect btn right">Radera <i class="material-icons small">delete</i></button></td>
                            			</tr>
                            		</tbody>
                            	</table>
                            	<input v-model="newTeam" type="text" placeholder="Lägg till lag">
                            	<button class="btn" v-on="click: addTeam">Lägg till</button>
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
