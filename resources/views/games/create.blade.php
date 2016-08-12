@extends('master')

@section('content')
<div class="row">
    <div class="col s12 m8 offset-m2">
        <div class="card orange darken-3">
            <div class="card-content">
                <div>
                    <a href="{{ route('home') }}" class="btn grey darken-2">
                        <i class="material-icons left">keyboard_arrow_left</i>Tillbaka
                    </a>
                </div>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Skapa nytt tips</span>
                        <div class="row">
                            <form id="create-game" action="{{ route('games.store')  }}" method="post" class="col s12 white">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                
                                <div class="input-field">
                                    <input type="text" id="name" name="name">
                                    <label for="name">Namn</label>
                                </div>

                                <div class="input-field">
                                    <input type="number" id="price" name="price">
                                    <label for="price">Pris</label>
                                </div>

                                <button name="select_game_type" class="btn green">Skapa</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
