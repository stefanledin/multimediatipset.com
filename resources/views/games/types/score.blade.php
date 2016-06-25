Speltyp: {{ $game->type }}

<label for="">Match</label>
@foreach($matches as $index => $match)
    <div>
        <input type="text" name="data[{{$index}}][match]" value="{{ $match->match }}" placeholder="Match">
        <input type="text" name="data[{{$index}}][result]" value="{{ $match->result }}" placeholder="Resultat">
        <input type="number" name="data[{{$index}}][worth]" value="{{ $match->worth }}" placeholder="Värde">
    </div>
@endforeach

<div>
    <input type="text" name="data[{{ count($matches) }}][match]" placeholder="Match">
    <input type="text" name="data[{{ count($matches) }}][result]" placeholder="Resultat">
    <input type="number" name="data[{{ count($matches) }}][worth]" placeholder="Värde">
</div>

<button>Lägg till</button>
