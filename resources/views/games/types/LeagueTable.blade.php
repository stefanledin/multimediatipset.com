<p>Dra och släpp lagen i den ordning du tror de slutar i tabellen:</p>
@if($game->game_data)
	<ol class="sortable">
	@foreach(unserialize($game->game_data) as $team)
		<li><input type="hidden" name="game-data[]" value="{{ $team }}">{{ $team }}</li>
	@endforeach
	</ol>
@endif