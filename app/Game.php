<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {

	protected $fillable = ['name', 'price', 'status', 'type', 'data', 'winner'];

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

	public function getDataAttribute($data)
	{
		return unserialize($data);
	}

	public function setDataAttribute($data)
	{
		$this->attributes['data'] = serialize($data);
	}

}
