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

    public function isCorrect()
    {
        return $this->answer == $this->question->answer;
    }

    public function setAnswerAttribute($value)
    {
        $this->attributes['answer'] = serialize( str_replace(' ', '', $value));
    }

    public function getAnswerAttribute($value)
    {
        return unserialize($value);
    }
}
