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
                    
                    @if($game->questions)
                        <h2>Tips</h2>
                        @foreach($game->questions as $question)
                            @if($question->answers)
                                @foreach($question->answers as $answer)
                                    {{ $answer->user->username }} har tippat: {{ $answer->answer }}
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                    
                    <h2>Lägg till tips</h2>
                    @if($game->questions)
                        @foreach($game->questions as $question)
                            <h3>{{ $question->title }}</h3>
                            <form action="{{ route('answers.store') }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="question_id" value="{{ $question->id }}">
                                <input type="hidden" name="game_id" value="{{ $game->id }}">
                                <input type="text" name="answer">

                                <input type="submit" value="Tippa">
                            </form>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
@stop
