<ul class="collection with-header">
    <li class="collection-header">
        <strong>{{ $question->title }}</strong>
        <span class="badge">
            <a href="{{ route('admin.questions.edit', $question->id) }}">Redigera</a>
        </span>
    </li>
    <li class="collection-item">
        Värd: {{ $question->worth }} poäng<br>
        Typ: {{ $question->type }}<br>
        Status: {{ $question->status }}<br>
        Resultat: {{ $question->answer }}
    </li>
</ul>