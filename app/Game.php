<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {

	protected $fillable = ['name', 'price', 'status', 'game_type', 'game_data', 'winner'];

	public function predictions()
	{
		return $this->hasMany('App\Prediction');
	}

}
