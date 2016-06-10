<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Game;
use App\Prediction;

use Illuminate\Http\Request;

class GamesController extends Controller {

	protected $gameStatuses = ['open' => 'Öppen', 'closed' => 'Stängd', 'finished' => 'Avslutad'];
	protected $gameTypes = ['Tabellplaceringar', '1-X-2', 'Resultat'];

	public function __construct()
	{
		$this->middleware('auth', ['only' => ['create', 'edit', 'destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $active_games = Game::where('status', '!=', 'finished')->get();
        $finished_games = Game::where('status', 'finished')->get();
        return view('games.index', [
            'active_games' => $active_games,
            'finished_games' => $finished_games
        ]);
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
            'game_type' => $request->input('game-type'),
            'game_data' => $request->input('game-data'),
            'status' => $request->input('status')
        ]);
        if ($game) {
			return redirect()->route('games.show', $game);
		}
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
		$game->load('predictions.user');
		// Loopa igenom varje tips
		$game->predictions->map(function ($prediction) use ($game)
		{
			// Loopa igenom varje match och rätta tipset
			collect($game->game_data['matches'])->each(function ($match, $index) use ($prediction)
			{
				$points = $match['worth'];
				$correctResult = $match['correct'];
				$predictedResult = $prediction->prediction['matches'][$index]['result'];
				if ($predictedResult == $correctResult) {
					$prediction->score += (int) $points;
				}
				$prediction->score += 0;
			});
		});
		$game->predictions->each(function ($prediction)
		{
			var_dump($prediction->score);
		});
		die();
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
		$game = Game::find($id);
		$game->load('predictions.user');
		return view('games.edit', [
			'game' => $game,
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
		$game->game_type = $request->input('game-type');
		if ($request->has('game_data')) {
			$game->game_data = $request->input('game_data');
		}
		if ($request->has('winner')) {
			$game->winner = $request->input('winner');
		}
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
		return redirect(route('home'));
	}

}
