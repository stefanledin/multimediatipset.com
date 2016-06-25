@extends('master')

@section('content')
<div class="row">
    <div class="col s12 m6 offset-m3">
        <div class="card orange darken-3">
            <div class="card-content">
                <div>
                    <a href="{{ route('home') }}" class="btn grey darken-2"><i class="mdi-hardware-keyboard-arrow-left left"></i>Tillbaka</a>
                </div>
                <span class="card-title">Skapa nytt tips</span>
                <div class="row">
                    <form id="create-game" action="{{ route('games.store')  }}" method="post" class="col s12 white">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="input-field col s12">
                            <label for="game_type">Välj typ av tips:</label>
                            <select name="type" id="game_type" class="browser-default">
                                <option value="Score">Resultat/poäng</option>
                            </select>
                        </div>
                        
                        <button name="select_game_type">Välj</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
