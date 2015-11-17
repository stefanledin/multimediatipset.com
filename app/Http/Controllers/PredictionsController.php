<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Game;
use App\Prediction;

use Illuminate\Http\Request;

class PredictionsController extends Controller {

	public function __construct()
	{
		#$this->middleware('auth');
	}

	public function store(Request $request)
	{
		$game = Game::find($request->input('game_id'));
		$prediction = new Prediction();
		if ($request->has('game-data')) {
			$prediction->prediction = serialize($request->input('game-data'));
		} else {
			$prediction->prediction = $request->input('score');
		}
		$game->predictions()->save($prediction);
		$user = \Auth::user();
		$user->predictions()->save($prediction);
		return redirect()->back();
	}

}
