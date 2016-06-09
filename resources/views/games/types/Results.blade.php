@if($game->game_data)
    @foreach($game->game_data as $data)
        <div class="input-field col s12">
            {{ $data }}
            <input type="radio" id="{{ $data }}_1" name="game-data[{{ $data }}_1]" value="1">
            <label for="{{ $data }}_1">1</label>
            
            <input type="radio" id="{{ $data }}_X" name="game-data[{{ $data }}_X]" value="X">
            <label for="{{ $data }}_X">X</label>
            
            <input type="radio" id="{{ $data }}_2" name="game-data[{{ $data }}_2]" value="2">
            <label for="{{ $data }}_2">2</label>
        </div>
    @endforeach
@endif