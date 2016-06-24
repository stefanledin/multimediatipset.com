Speltyp: {{ $game->type }}

<label for="">Match</label>
@foreach($matches as $index => $match)
    <input type="text" name="data[{{$index}}][match]" value="{{ $match->match }}">
    <input type="text" name="data[{{$index}}][result]" value="{{ $match->result }}">
    <input type="number" name="data[{{$index}}][worth]" value="{{ $match->worth }}">
@endforeach

<input type="text" name="data[{{ count($matches) }}][match]">
<input type="text" name="data[{{ count($matches) }}][result]">
<input type="number" name="data[{{ count($matches) }}][worth]">

<button>Lägg till</button>
