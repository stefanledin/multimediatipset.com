<div class="input-field">
    <input type="number" id="worth" name="worth" value="{{ $question->worth }}">
    <label for="worth">Värde</label>
</div>
@foreach(['-', '1', 'X', '2'] as $alternative)
    <div class="input-field">
        <input type="radio" id="answer{{ $alternative }}" name="answer" value="{{ $alternative }}" @if($question->answer == $alternative)checked="checked"@endif>
        <label for="answer{{ $alternative }}">{{ $alternative }}</label>
    </div>
@endforeach
