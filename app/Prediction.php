<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model {

	protected $fillable = ['data', 'user_id', 'game_id'];

	public function game()
	{
		return $this->belongsTo('App\Game');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

    public function getDataAttribute($data)
    {
        return unserialize($data);
    }

    public function setDataAttribute($data)
    {
        $this->attributes['data'] = serialize($data);
    }

}
