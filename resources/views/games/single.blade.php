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
                    <p>Pris: {{ $game->price }} kr.</p>
                    <p>I potten: {{ $game->inPot() }} kr</p>
                    <p>Speltyp: {{ $game->type }}</p>

                    Frågor:
                    Resultat
                    Värd: 1 poäng

                    <form action="{{ route('admin.questions.store') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="game_id" value="{{ $game->id }}">
                        <input type="text" name="title">
                        <input type="number" name="worth">

                        <input type="submit" value="Lägg till">
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop
