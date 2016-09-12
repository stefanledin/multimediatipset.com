<?php

namespace App\Answer\PointCounter\Type;

use App\Answer;

class Order {

    protected $answer;
    protected $correct;
    protected $points;

    function __construct(Answer $answer)
    {
        $this->answer = $answer;
        $this->correct = $answer->question->answer;
    }

    public function count()
    {
        return $this->countDefaultWorth()->countTeamPosition();
    }

    protected function countDefaultWorth()
    {
        $worth = $this->answer->question->worth['default'];
        $answer = collect($this->answer->answer);
        $this->points += $answer->map(function($item, $index) use ($worth) {
            if ($item == $this->correct[$index]) {
                return $worth;
            }
            return 0;
        })->sum();
        return $this;
    }

    protected function countTeamPosition()
    {
        $this->points += 5;
        return $this;
    }

}