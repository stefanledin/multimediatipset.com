<ul class="collection with-header">
    <li class="collection-header">
        <strong>{{ $question->title }}</strong>
        <span class="badge">
            <a href="{{ route('admin.questions.edit', $question->id) }}">Redigera</a>
        </span>
    </li>
    @foreach($question->alternatives as $alternative)
        <li class="collection-item">{{ $alternative }}</li>
    @endforeach
</ul>