<div class="card">
    <div class="card-content">
        <span class="card-title">Svarsalternativ</span>
        <div class="collection">
            @for($i = 0; $i < count($question->alternatives)+1; $i++)
                <div class="collection-item">
                    <div class="input-field">
                        <input type="text" name="alternative[{{$i}}]" id="alternative[{{$i}}]" @if(isset($question->alternatives[$i])) value="{{ $question->alternatives[$i] }}" @endif>
                        <label for="alternative[{{$i}}]">Alternativ {{ $i + 1 }}</label>
                    </div>
                </div>
            @endfor
        </div>
        <div class="input-field">
            <input type="submit" class="btn blue" value="Lägg till">
        </div>
    </div>
</div>

<div class="card">
    <div class="card-content">
        <span class="card-title">Frågor</span>
        <div class="collection-item">
            <div class="input-field">
                
            </div>
        </div>
    </div>
</div>