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

                            <input type="submit" value="Spara">
                        </form>

                        @if($game->questions)
                        <h2>Frågor</h2>
                            @foreach($game->questions as $question)
                                {{ $question->title }} <a href="{{ route('admin.questions.edit', $question->id) }}">Redigera</a>
                                Värd: {{ $question->worth }} poäng
                                Typ: {{ $question->type }}
                            @endforeach
                        @endif

                        <h2>Lägg till fråga</h2>
                        <form action="{{ route('admin.questions.store') }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="game_id" value="{{ $game->id }}">
                            
                            <div class="input-field col s12">
                                <label for="question_type">Välj typ av tips:</label>
                                <select name="type" id="question_type" class="browser-default">
                                    <option value="Score">Resultat/poäng</option>
                                </select>
                            </div>
                            
                            <input type="text" name="title">
                            <input type="number" name="worth">

                            <input type="submit" value="Lägg till">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop