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

                    <form action="{{ route('predictions.store') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="game_id" value="{{ $game->id }}">
                        @foreach($matches as $index => $match)
                            <label>{{ $match->match }}</label>
                            <input type="text" name="data[{{$index}}][answer]">
                        @endforeach

                        <button>Tippa</button>
                    </form>

                    @if($predictions)
                        @foreach($predictions as $index => $prediction)
                            {{ $prediction->user->username }} har tippat: {{ $prediction->data[$index]['answer'] }}
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
@stop
