@extends('master')

@section('content')
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card orange darken-3">
                <div class="card-content">
                    <div>
                        <a href="{{ route('admin.games.edit', $question->game_id) }}" class="btn grey darken-3">
                            <i class="material-icons left">keyboard_arrow_left</i>
                            Tillbaka
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Redigera fråga: {{ $question->title }}</span>
                            <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="game_id" value="{{ $question->game_id }}">
                                
                                <div class="input-field">
                                    <input type="text" name="title" value="{{ $question->title }}">
                                    <label for="title">Titel</label>
                                </div>
                                
                                <div>
                                    <label for="question_type">Välj typ av tips:</label>
                                    <select name="type" id="question_type" class="browser-default">
                                        @foreach($gameTypes as $type => $label)
                                            <option value="{{ $type }}" @if($question->type == $type) selected="selected" @endif>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="question_status">Välj status</label>
                                    <select name="status" id="question_status" class="browser-default">
                                        @foreach(['open' => 'Öppen', 'closed' => 'Stängd', 'finished' => 'Avslutad'] as $value => $label)
                                            <option value="{{ $value }}" @if($question->status == $value) selected="selected" @endif>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                
                                @include('questions.types.'.$question->type)

                                <div class="input-field">
                                    <input type="submit" value="Uppdatera" class="btn green">
                                </div>
                            </form>
                            <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                
                                <div class="input-field">
                                    <input type="submit" value="Radera" class="btn red">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop