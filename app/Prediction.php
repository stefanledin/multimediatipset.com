<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model {

	protected $fillable = ['prediction', 'user_id', 'game_id'];

	public function game()
	{
		return $this->belongsTo('App\Game');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

}
