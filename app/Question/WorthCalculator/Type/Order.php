<?php

namespace App\Question\WorthCalculator\Type;

use App\Question;

class Order {

    protected $question;
    protected $worth = 0;
    
    function __construct(Question $question) {
        $this->question = $question;
    }

    public function count()
    {
        $this->defaultWorth()
            ->correctAlternativesPositionWorth()
            ->correctPositionWorth();
            
        return $this->worth;
    }

    protected function defaultWorth()
    {
        $this->worth += $this->question->worth['default'] * count($this->question->alternatives);
        return $this;
    }

    protected function correctAlternativesPositionWorth()
    {
        if (isset($this->question->worth['alternatives'])) {
            $this->worth += collect($this->question->worth['alternatives'])->sum();
        }
        return $this;
    }

    protected function correctPositionWorth()
    {
        if (isset($this->question->worth['positions'])) {
            $this->worth += collect($this->question->worth['positions'])->sum();
        }
        return $this;
    }
}