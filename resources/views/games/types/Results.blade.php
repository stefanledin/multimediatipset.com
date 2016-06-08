@if($game->game_data)
    @foreach($game->game_data as $data)
        <li>{{ $data }}</li>
    @endforeach
@endif