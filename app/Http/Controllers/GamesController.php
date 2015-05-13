<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Game;
use App\Prediction;

use Illuminate\Http\Request;

class GamesController extends Controller {

	protected $gameStatuses = ['open' => 'Öppen', 'closed' => 'Stängd', 'finished' => 'Avslutad'];

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$active_games = Game::all();
		return view('games.index', ['active_games' => $active_games]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('games.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$game = Game::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'status' => $request->input('status')
        ]);
        if ($game) {
			return redirect()->route('games.show', $game);
		}
		dd($game);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$game = Game::find($id);
		return view('games.single', ['game' => $game]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view('games.edit', [
			'game' => Game::find($id),
			'statuses' => $this->gameStatuses
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$game = Game::find($id);
		$game->name = $request->input('name');
		$game->price = $request->input('price');
		$game->status = $request->input('status');
		$game->save();
		return redirect()->route('games.show', $game->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Game::destroy($id);
		return redirect()->back();
	}

}
