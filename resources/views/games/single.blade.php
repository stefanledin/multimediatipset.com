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
                    @if(count($game->predictions) != 0)
                    <ul class="collection">
                        @foreach($game->predictions as $prediction)
                            <li class="collection-item avatar">
                                <img src="{{ $prediction->user->profile_picture_thumbnail }}" class="circle">
                                <span class="title">{{ $prediction->user->username }} har tippat:</span>
                                @if($game->game_type == 'LeagueTable')
                                    <ol>
                                        @foreach(unserialize($prediction->prediction) as $prediction)
                                            <li>{{ $prediction }}</li>
                                        @endforeach
                                    </ol>
                                @elseif($game->game_type == 'Series')
                                    <ul>
                                        @foreach(unserialize($prediction->prediction) as $teams => $result)
                                        <li><strong>{{ $teams }}:</strong> {{ $result }}</li>
                                        @endforeach
                                    </ul>
                                @elseif($game->game_type == 'Results')
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Match</th>
                                                <th>1</th>
                                                <th>X</th>
                                                <th>2</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for($i = 0; $i < count($prediction->prediction['matches']); $i++)
                                                @if($prediction->prediction['matches'][$i]['result'])
                                                <tr>
                                                    <td>{{ $prediction->prediction['matches'][$i]['match'] }}</td>
                                                    <td>
                                                    @if($prediction->prediction['matches'][$i]['result'] == '1')
                                                        {{ $prediction->prediction['matches'][$i]['result'] }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                    @if($prediction->prediction['matches'][$i]['result'] == 'X')
                                                        {{ $prediction->prediction['matches'][$i]['result'] }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                    @if($prediction->prediction['matches'][$i]['result'] == '2')
                                                        {{ $prediction->prediction['matches'][$i]['result'] }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endif
                                            @endfor
                                        </tbody>
                                    </table>
                                @else
                                    <strong>{{ $prediction->prediction }}</strong>
                                    @if($game->winner && $game->winner == $prediction->id)
                                        <span class="secondary-content"><i class="material-icons">grade</i></span>
                                    @endif
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    @endif
                    @if(Auth::check())
                        @if(Auth::user()->is_admin)
                        <div class="row">
                            <a href="{{ route('games.edit', $game->id) }}" class="btn green col s6">Redigera</a>
                            <form action="{{ route('games.destroy', $game->id) }}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn red darken-2 col s6" value="Radera">
                            </form>
                        </div>
                        @endif
                        @if($game->status == 'open')
                            <div class="row">
                            {!! Form::open(['route' => 'predictions.store', 'class' => 'col s12 white']) !!}
                                {!! Form::hidden('game_id', $game->id) !!}

                                @include('games.types.'.$game->game_type)
                                
                                <div class="input-field col s4">
                                    {!! Form::submit('Tippa', ['class' => 'btn orange']) !!}
                                </div>
                            {!! Form::close() !!}
                            </div>
                        @endif
                    @else
                        <p><a href="/login" class="btn green">Logga in för att lämna ditt tips</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
