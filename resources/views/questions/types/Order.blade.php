<div class="row">
    <div class="col s12 m6">
        
        <div class="card">
            <div class="card-content">
                <span class="card-title">Alternativ</span>
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
                <span class="card-title">Värde</span>
            
                <div class="collection with-header">
                    <div class="collection-header">
                        <strong>Default</strong>
                    </div>
                    <div class="collection-item">
                        <div class="input-field">
                            <input type="text" name="worth[default]" id="worth[default]"@if (isset($question->worth['default'])) value="{{ $question->worth['default'] }}" @endif>
                            <label for="worth[default]">Default</label>
                        </div>
                    </div>
                </div>

                <div class="input-field">
                    <input type="submit" class="btn blue" value="Spara">
                </div>

                <div class="collection with-header">
                    <div class="collection-header">
                        <strong>Alternativ</strong>
                    </div>
                    @for ($i = 0; $i < count($question->alternatives); $i++)
                        <div class="collection-item">
                            <div class="input-field">
                                <input type="text" name="worth[alternatives][{{$question->alternatives[$i]}}]" id="worth[alternatives][{{$question->alternatives[$i]}}]"@if (isset($question->worth['alternatives'][$question->alternatives[$i]])) value="{{ $question->worth['alternatives'][$question->alternatives[$i]] }}" @endif>
                                <label for="worth[alternatives][{{$question->alternatives[$i]}}]">{{ $question->alternatives[$i] }}</label>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="input-field">
                    <input type="submit" class="btn blue" value="Spara">
                </div>

                <div class="collection with-header">
                    <div class="collection-header">
                        <strong>Positioner</strong>
                    </div>
                    @for ($i = 1; $i <= count($question->alternatives); $i++)
                        <div class="collection-item">
                            <div class="input-field">
                                <input type="text" name="worth[positions][{{$i}}]" id="worth[positions][{{$i}}]"@if (isset($question->worth['positions'][$i])) value="{{ $question->worth['positions'][$i] }}" @endif>
                                <label for="worth[positions][{{$i}}">Position {{$i}}</label>
                            </div>
                        </div>
                    @endfor
                </div>
                
                <div class="input-field">
                    <input type="submit" class="btn blue" value="Spara">
                </div>

            </div>

        </div>

    </div>
</div>
