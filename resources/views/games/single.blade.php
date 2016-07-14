@extends('master')

@section('content')
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="card orange darken-3">
                <div class="card-content">
                    <div>
                        <a href="{{ route('home') }}" class="btn grey darken-2"><i class="mdi-hardware-keyboard-arrow-left left"></i>Tillbaka</a>
                    </div>
                    <div><a href="{{ route('admin.games.edit', $game->id) }}">Redigera</a></div>
                    <span class="card-title">{{ $game->name }}</span>
                    <p>Pris: {{ $game->price }} kr.</p>
                    <p>I potten: {{ $game->inPot() }} kr</p>
                    
                    @if($game->questions)
                        <h2>Tips</h2>
                        @foreach($game->questions as $question)
                            @if(!empty($question->answers))
                                @foreach($question->answers as $answer)
                                    {{ $answer->user->username }} har tippat: {{ $answer->answer }}
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                    
                    <h2>Lägg till tips</h2>
                    @if($game->questions)
                        <form action="{{ route('answers.store') }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="game_id" value="{{ $game->id }}">
                            @foreach($game->questions as $question)
                                <input type="hidden" name="question_id" value="{{ $question->id }}">
                                <h3>{{ $question->title }}</h3>
                                <input type="text" name="answer[{{$question->id}}]">

                            @endforeach
                            <input type="submit" value="Tippa">
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
@stop
