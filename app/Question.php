<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use Auth;

class Question extends Model
{
    protected $fillable = ['title', 'alternatives', 'worth', 'type', 'answer', 'game_id', 'status'];

    /**
     * Relationen mellan Question och Game
     */ 
    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    /**
     * Relationen mellan Question och Answer
     */
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    /**
     * Returnerar antalet svar ansvändaren gett
     * på denna frågan
     * @param  User   $user 
     * @return integer
     */
    public function answeredByUser(User $user)
    {
        return $this->answers()->where('user_id', $user->id)->get()->count();
    }

    /**
     * Returnerar en collection med användare
     * som svarat rätt på frågan.
     * @return collection Collection av User
     */
    public function playersWithCorrectAnswers()
    {
        return $this->correctAnswers()->map(function ($answer)
        {
            return $answer->user;
        });
    }

    /**
     * Returnerar svar som är rätta
     * @return collection Collection med Answers
     */
    public function correctAnswers()
    {
        return $this->answers->filter(function($answer) {
            return $answer->isCorrect();
        });
    }

    public function worth()
    {
        $worthCalculator = 'App\Question\WorthCalculator\Type\\'.$this->type;
        if (class_exists($worthCalculator)) {
            return (new $worthCalculator($this))->count();
        }
        return $this->worth;
    }

    /**
     * Leaderboard
     * @return object 
     */
    public function leaderBoard()
    {
        $players = $this->answers->sortBy(function ($answer) {
            return $answer->points();
        })->reverse()->map(function ($answer)
        {
            $answer->user->points = $answer->points();
            $answer->user->isCorrect = $answer->isCorrect();
            return $answer->user;
        });
        return (object) [
            'players' => $players
        ];
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
        $value = collect($value)->reject(function($row) {
            return empty($row);
        })->toArray();
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

    /**
     * Mutators för Answer
     */
    public function getAnswerAttribute()
    {
        return unserialize($this->attributes['answer']);
    }
    public function setAnswerAttribute($value)
    {
        $this->attributes['answer'] = serialize($value);
    }

}
