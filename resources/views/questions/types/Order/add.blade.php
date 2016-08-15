<ul class="collection with-header">
    <li class="collection-header">
        <strong>{{ $question->title }}</strong>
        <p>Dra och släpp till den ordning du tror.</p>
    </li>
    @foreach($question->alternatives as $index => $alternative)
        <li class="collection-item">
            {{ $index + 1 }}. {{ $alternative }}
            <input type="hidden" name="answer[{{ $question->id }}][]" value="{{ $alternative }}">
        </li>
    @endforeach
</ul>