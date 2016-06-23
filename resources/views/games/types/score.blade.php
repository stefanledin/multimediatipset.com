Speltyp: {{ $game->type }}

<label for="">Match</label>
@for($i = 0; $i < count($game->data); $i++)
    <input type="text" name="data[{{$i}}][match]">
    <input type="number" name="data[{{$i}}][worth]">
@endfor
<button>Lägg till</button>