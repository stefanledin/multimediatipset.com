<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model {

	protected $fillable = ['prediction', 'user_id'];

	public function game()
	{
		return $this->belongsTo('App\Game');
	}

}
