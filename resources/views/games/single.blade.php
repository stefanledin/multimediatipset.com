@extends('master')

@section('content')
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card orange darken-3">
                <div class="card-content">
                    <div class="row">
                        <a href="{{ route('home') }}" class="btn left grey darken-2">
                            <i class="material-icons left">keyboard_arrow_left</i>Tillbaka
                        </a>
                        @if(Auth::check() && Auth::user()->is_admin)
                            <a href="{{ route('admin.games.edit', $game->id) }}" class="btn right grey darken-3">
                                Redigera
                                <i class="material-icons right">mode_edit</i>
                            </a>
                        @endif
                    </div>
                    
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">{{ $game->name }}</span>
                            <p>Pris: {{ $game->price }} kr.</p>
                            <p>I potten: {{ $game->inPot() }} kr</p>
                        </div>
                    </div>

                    @if($questionsWithAnswers)
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Ställning</span>
                                <table>
                                    <thead>
                                        <th>#</th>
                                        <th>Namn</th>
                                        <th>Rätt</th>
                                        <th>Poäng</th>
                                    </thead>
                                    <tbody>
                                        @foreach($leaderBoard->players as $index => $player)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $player->username }}</td>
                                            <td>{{ $player->correctAnswers }} / {{ count($questionsWithAnswers) }}</td>
                                            <td>{{ $player->points }} / {{ $game->pointsAvaliable() }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    @if($game->questions)
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Tips</span>
                                @foreach($game->questions as $question)
                                    <ul class="collection with-header"> 
                                        <li class="collection-header">
                                            <strong>{{ $question->title }}</strong>
                                        </li>
                                        @if(count($question->answers))
                                        @foreach($question->answers as $answer)
                                            <li class="collection-item"> 
                                                @if(($question->answer != '-') && ($question->answer != ''))
                                                    @if($answer->isCorrect())
                                                        <i class="tiny left material-icons green-text">check</i>
                                                    @else
                                                        <i class="tiny left material-icons red-text">clear</i>
                                                    @endif
                                                @endif

                                                @include('answers.types.'.$question->type.'.list')
                                                
                                            </li>
                                        @endforeach
                                        @else
                                            <li class="collection-item">
                                                <span>Inga tips ännu.</span>
                                            </li>
                                        @endif
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    @if(Auth::check() && count($questions))
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Lägg till tips</span>
                                @if($errors->any())
                                    <div class="card-panel red white-text">
                                        <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if($questions)
                                    <form action="{{ route('answers.store') }}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="game_id" value="{{ $game->id }}">
                                        @foreach($questions as $index => $question)
                                            <input type="hidden" name="question_type" value="{{ $question->type }}">
                                            <div class="card">
                                                <div class="card-content">
                                                    @include('questions.types.'.$question->type.'.add')
                                                </div>
                                            </div>
                                        @endforeach
                                        <input type="submit" class="btn green" value="Tippa">
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@stop
