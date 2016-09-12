<?php

namespace App\Answer\PointCounter\Type;

use App\Answer;

class Score {

    protected $answer;

    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    public function count()
    {
        if ($this->answer->answer == $this->answer->question->answer) {
            return $this->answer->question->worth;
        }
        return 0;
    }

}