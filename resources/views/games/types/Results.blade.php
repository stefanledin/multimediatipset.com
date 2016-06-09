@if($game->game_data)
    <div class="input-field col s12">
        <table>
            <thead>
                <tr>
                    <th>Match</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Rätt svar</th>
                </tr>
            </thead>
            <tbody>
                @for($i = 0; $i < count($game->game_data['matches']); $i++)
                    <tr @if(isset($game->game_data['matches'][$i]['highlighted'])) class="blue lighten-5" @endif>
                        <td>
                            {{ $game->game_data['matches'][$i]['match'] }}
                            <input type="hidden" name="game-data[matches][{{ $i }}][match]" value="{{ $game->game_data['matches'][$i]['match'] }}">
                        </td>
                        <td>
                            <input type="radio" value="1" id="match-{{ $i }}-1" name="game-data[matches][{{ $i }}][result]">
                            <label for="match-{{ $i }}-1">1</label>
                        </td>
                        <td>
                            <input type="radio" value="X" id="match-{{ $i }}-X" name="game-data[matches][{{ $i }}][result]">
                            <label for="match-{{ $i }}-X">X</label>
                        </td>
                        <td>
                            <input type="radio" value="2" id="match-{{ $i }}-2" name="game-data[matches][{{ $i }}][result]">
                            <label for="match-{{ $i }}-2">2</label>
                        </td>
                        <td>{{ $game->game_data['matches'][$i]['worth'] }} poäng</td>
                    </tr>
                @endfor
            </tbody>
        </table>            
    </div>
@endif