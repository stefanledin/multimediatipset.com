@if($game->game_data)
    <?php $i = 0; ?>
	@foreach(unserialize($game->game_data) as $team)
        <div class="input-field col s12">
            <input id="series-<?php echo $i;?>" type="text" name="game-data[{{ $team }}]">
            <label for="series-<?php echo $i;?>">{{ $team }}</label>
        </div>
        <?php $i++; ?>
	@endforeach
@endif

