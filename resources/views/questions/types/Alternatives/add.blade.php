<input type="hidden" name="question_id" value="{{ $question->id }}">
<div class="collection with-header">
    <div class="collection-header"><strong>{{ $question->title }}</strong></div>
    @foreach(['-', '1', 'X', '2'] as $index => $alternative)
        <div class="collection-item">
            <input type="radio" id="answer{{ $alternative }}" name="answer[{{$question->id}}]" value="{{ $alternative }}" @if($index == 0)checked="checked"@endif>
            <label for="answer{{ $alternative }}">{{ $alternative }}</label>
        </div>
    @endforeach
</div>
