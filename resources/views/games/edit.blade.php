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
                        <form action="{{ route('games.update', $game) }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                            <label for="name">Namn</label>
                            <input type="text" id="name" name="name" value="{{ $game->name }}">

                            <label for="price">Pris</label>
                            <input type="number" id="price" name="price" value="{{ $game->price }}">

                            @include('games.types.'.$game->type)
                
                            <button>Spara</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop