<form action="{{ route('admin.questions.store') }}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="game_id" value="{{ $question->game_id }}">
    
    <div class="input-field col s12">
        <label for="question_type">Välj typ av tips:</label>
        <select name="type" id="question_type" class="browser-default">
            <option value="Score">Resultat/poäng</option>
        </select>
    </div>
    
    <input type="text" name="title" value="{{ $question->title }}">
    <input type="number" name="worth" value="{{ $question->title }}">

    <input type="submit" value="Uppdatera">
</form>