<div class="input-field">
    <input type="hidden" name="question_id" value="{{ $question->id }}">
    <input type="text" id="answer[{{$question->id}}]" name="answer[{{$question->id}}]" value="{{ old('answer')[$question->id] }}">
    <label for="answer[{{$question->id}}]">{{ $question->title }}</label>
</div>