<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'alternatives', 'worth', 'type', 'answer', 'game_id'];

    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    /**
     * Mutators för Alternatives
     */
    public function getAlternativesAttribute($value)
    {
        if ($this->attributes['alternatives']) {
            return unserialize($this->attributes['alternatives']);
        }
        // En tom array som standard
        return [''];
    }
    public function setAlternativesAttribute($value)
    {
        $this->attributes['alternatives'] = serialize($value);
    }

    /**
     * Mutators för Worth
     */
    public function getWorthAttribute()
    {
        return unserialize($this->attributes['worth']);
    }
    public function setWorthAttribute($value)
    {
        $this->attributes['worth'] = serialize($value);
    }

    public function correctAnswers()
    {
        return $this->answers->filter(function($answer) {
            return $answer->isCorrect();
        });
    }

    public function playersWithCorrectAnswers()
    {
        return $this->correctAnswers()->map(function ($answer)
        {
            return $answer->user;
        });
    }

    public function leaderBoard()
    {
        $players = $this->answers->sortBy(function ($answer) {
            return ($answer->isCorrect()) ? 1 : 0;
        })->reverse()->map(function ($answer)
        {
            $answer->user->points = ($answer->isCorrect()) ? $this->worth : 0;
            $answer->user->isCorrect = $answer->isCorrect();
            return $answer->user;
        });
        return (object) [
            'players' => $players
        ];
    }
}
