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

                    @if(Auth::check())
                    <div style="background: white;">
                        <form action="{{ route('predictions.store') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="game_id" value="{{ $game->id }}">
                            @foreach($matches as $index => $match)
                                <div class="input-field">
                                    <input type="hidden" name="data[{{$index}}][match]" value="{{$match->match}}">
                                    <input type="text" name="data[{{$index}}][answer]" placeholder="Ditt tips" id="match[{{$index}}]">
                                    <label for="match[{{$index}}]">{{ $match->match }}</label>
                                </div>
                            @endforeach

                            <button>Tippa</button>
                        </form>
                    </div>
                    @endif

                    @foreach($predictions as $userPrediction)
                        <p>{{ $userPrediction->user->username }} har tippat: </p>
                        @foreach($userPrediction->data as $prediction)
                            <div>
                                {{ $prediction['match'] }} {{ $prediction['answer'] }}
                            </div>
                        @endforeach
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@stop
