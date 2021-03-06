<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['answer', 'user_id', 'question_id'];

    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function points()
    {
        $pointCounter = 'App\Answer\PointCounter\Type\\'. $this->question->type;
        return (new $pointCounter($this))->count();
    }

    public function isCorrect()
    {
        return (bool) $this->points();
    }

    public function setAnswerAttribute($value)
    {
        $this->attributes['answer'] = serialize($value);
    }

    public function getAnswerAttribute($value)
    {
        return unserialize($value);
    }

    public function setWorthAttribute($value)
    {
        $this->attribute['worth'] = serialize($value);
    }

    public function getWorthAttribute($value)
    {
        return unserialize($value);
    }
}
