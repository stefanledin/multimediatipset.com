<div class="collection with-header">
    <div class="collection-header">
        <strong>{{ $question->title }}</strong>
        <span class="badge">
            <a href="{{ route('admin.questions.edit', $question->id) }}">Redigera</a>
        </span>
    </div>
    <div class="collection-item">
        Värd: {{ $question->worth }} poäng<br>
        Typ: {{ $question->type }}
    </div>
</div>