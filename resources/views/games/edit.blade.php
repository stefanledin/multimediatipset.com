@extends('master')

@section('content')
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="card orange darken-3">
                <div class="card-content">
                    <div>
                        <a href="{{ route('home') }}" class="btn grey darken-2"><i class="mdi-hardware-keyboard-arrow-left left"></i>Tillbaka</a>
                    </div>
                    <div class="row">

                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Redigera tips</span>
                                <form action="{{ route('games.update', $game) }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    
                                    <div class="input-field">
                                        <input type="text" id="name" name="name" value="{{ $game->name }}">
                                        <label for="name">Namn</label>
                                    </div>
                                
                                    <div class="input-field">
                                        <input type="number" id="price" name="price" value="{{ $game->price }}">
                                        <label for="price">Pris</label>
                                    </div>
                                
                                    <input type="submit" value="Spara" class="btn green">
                                </form>
                            </div>
                        </div>

                        @if($game->questions)
                            <ul class="collection with-header">
                                <li class="collection-header">
                                    <strong>Frågor</strong>
                                </li>
                                @foreach($game->questions as $question)
                                    <li class="collection-item">
                                        {{ $question->title }}<br>
                                        Värd: {{ $question->worth }} poäng<br>
                                        Typ: {{ $question->type }}
                                        <span class="badge">
                                            <a href="{{ route('admin.questions.edit', $question->id) }}">Redigera</a>
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <h3>Lägg till fråga</h3>
                        <form action="{{ route('admin.questions.store') }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="game_id" value="{{ $game->id }}">
                            
                            <div class="input-field col s12">
                                <select name="type" id="question_type">
                                    <option value="Score">Resultat/poäng</option>
                                </select>
                                <label>Välj typ av tips:</label>
                            </div>
                            
                            <div class="input-field col s12">
                                <input type="text" name="title" id="title">
                                <label for="title">Namn</label>
                            </div>
                            
                            <div class="input-field col s12">
                                <input type="number" name="worth" id="worth">
                                <label for="worth">Värde</label>
                            </div>

                            <input type="submit" value="Lägg till" class="btn green">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop