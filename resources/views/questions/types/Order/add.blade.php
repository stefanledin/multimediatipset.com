<input type="hidden" name="question_id" value="{{ $question->id }}">
<ul class="collection with-header sortable">
    <li class="collection-header">
        <strong>{{ $question->title }}</strong>
        <p>Dra och släpp till den ordning du tror.</p>
    </li>
    @foreach($question->alternatives as $index => $alternative)
        <li class="collection-item">
            {{ $alternative }}
            <input type="hidden" name="answer[{{$question->id}}][]" value="{{ $alternative }}">
        </li>
    @endforeach
</ul>