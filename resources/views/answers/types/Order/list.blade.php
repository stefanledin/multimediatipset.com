{{ $answer->user->username }} har tippat:
<ol class="collection">
    @foreach($answer->answer as $team)
        <li class="collection-item">{{ $team }}</li>
    @endforeach
</ol>