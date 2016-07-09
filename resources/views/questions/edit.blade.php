<form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="PUT">
    <input type="text" name="title" value="{{ $question->title }}">
    <input type="number" name="worth" value="{{ $question->worth }}">

    <input type="submit" value="Uppdatera">
</form>