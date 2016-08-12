@extends('master')

@section('content')
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card orange darken-3">
                <div class="card-content">
                    <div>
                        <a href="{{ route('games.show', $game->id) }}" class="btn grey darken-2">
                            <i class="material-icons left">keyboard_arrow_left</i>Tillbaka
                        </a>
                    </div>

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

                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Frågor</span>
                            @if(count($game->questions))
                                @foreach($game->questions as $question)
                                <ul class="collection with-header">
                                    <li class="collection-header">
                                        <strong>{{ $question->title }}</strong>
                                        <span class="badge">
                                            <a href="{{ route('admin.questions.edit', $question->id) }}">Redigera</a>
                                        </span>
                                    </li>
                                    <li class="collection-item">
                                        Värd: {{ $question->worth }} poäng<br>
                                        Typ: {{ $question->type }}
                                    </li>
                                </ul>
                                @endforeach
                            @else
                                <span>Inga frågor tillagda</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Lägg till fråga</span>
                            <form action="{{ route('admin.questions.store') }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="game_id" value="{{ $game->id }}">

                                <div>
                                    <label>Välj typ av tips:</label>
                                    <select name="type" id="question_type" class="browser-default">
                                        @foreach($gameTypes as $type => $label)
                                            <option value="{{ $type }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="input-field">
                                    <input type="text" name="title" id="title">
                                    <label for="title">Namn</label>
                                </div>
                                
                                <div class="input-field">
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
    </div>
@stop