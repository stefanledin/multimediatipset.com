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
        $this->middleware('auth', ['only' => ['create', 'edit', 'update', 'destroy']]);
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
            'type' => $request->input('type'),
            'data' => [
                []
            ]
        ]);
        if ($game) {
            return redirect()->route('games.edit', $game);
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
        $leaderboard = $game->predictions->map(function ($prediction) use ($game)
        {
            // Loopa igenom varje match och rätta tipset
            collect($game->game_data['matches'])->each(function ($match, $index) use ($prediction)
            {
                $points = $match['worth'];
                $correctResult = $match['correct'];
                $predictedResult = $prediction->prediction['matches'][$index]['result'];
                
                if ($predictedResult == $correctResult) {
                    $prediction->correctAnswers += 1;
                    $prediction->score += (int) $points;
                }
                $prediction->correctAnswers += 0;
                $prediction->score += 0;
            });
            return $prediction;
        })
        ->sortBy('score')
        ->reverse();
        $finished_matches = collect($game->game_data['matches'])->filter(function($match) {
            return $match['correct'] != '0';
        });
        $maxNumberOfPoints = collect($game->game_data['matches'])->map(function($match){
            if ($match['correct'] != '0') {
                return (int) $match['worth'];
            }
            return 0;
        })->sum();
        return view('games.single', compact('game', 'leaderboard', 'finished_matches', 'maxNumberOfPoints'));
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
        #$game->load('predictions.user');
        return view('games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);
        $game->name = $request->input('name');
        $game->price = $request->input('price');
        $game->save();
        return redirect()->route('games.edit', $game->id);
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
