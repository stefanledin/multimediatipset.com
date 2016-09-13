<?php

namespace App\Answer\PointCounter\Type;

use App\Answer;

class Order {

    protected $answer;
    protected $question;
    protected $correct;
    protected $points = 0;

    function __construct(Answer $answer)
    {
        $this->answer = $answer;
        $this->question = $answer->question;
        $this->correct = $answer->question->answer;
    }

    public function count()
    {
        $this->countDefaultWorth()->countTeamPosition()->countCorrectPosition();
        return $this->points;
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
        $this->points += collect($this->answer->answer)->map(function ($item, $index)
        {
            if ($item == $this->correct[$index]) {
                if (isset($this->question->worth['teams'][$item])) {
                    return $this->question->worth['teams'][$item];
                }
            }
            return 0; 
        })->sum();
        return $this;
    }

    protected function countCorrectPosition()
    {
        $this->points += collect($this->answer->answer)->map(function ($item, $index) {
            if (isset($this->question->worth['positions'][$index+1])) {
                $worth = $this->question->worth['positions'][$index+1];
                if ($item == $this->correct[$index]) {
                    return $worth;
                }
            }
            return 0;
        })->sum();
        return $this;
    }

}