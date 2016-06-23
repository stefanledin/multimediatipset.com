<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {

	protected $fillable = ['name', 'price', 'status', 'type', 'game_data', 'winner'];

	public function predictions()
	{
		return $this->hasMany('App\Prediction');
	}

	public function inPot()
	{
		$predictions = $this->predictions;
		if (count($predictions) != 0) {
			return count($predictions) * $this->price;
		}
		return 0;
	}

	public function getGameDataAttribute($game_data)
	{
		return unserialize($game_data);
	}

	public function setGameDataAttribute($game_data)
	{
		$this->attributes['game_data'] = serialize($game_data);
	}

}
