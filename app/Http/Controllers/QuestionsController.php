<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Question;
use App\Game;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new Question([
            'title' => $request->input('title'),
            'worth' => $request->input('worth'),
            'type' => $request->input('type'),
            'status' => 'open'
        ]);
        $game = Game::find($request->input('game_id'));
        $game->questions()->save($question);
        return redirect(route('admin.questions.edit', $question->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        $gameTypes = $this->gameTypes;
        return view('questions.edit', compact('question', 'gameTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::find($id);
        $question->title = $request->input('title');
        $question->alternatives = $request->input('alternative');
        $question->worth = $request->input('worth');
        $question->type = $request->input('type');
        $question->answer = $request->input('answer');
        $question->status = $request->input('status');
        $question->save();
        $game = Game::find($question->game_id);
        return redirect(route('admin.questions.edit', $question->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();
        return redirect(route('admin.games.edit', $question->game->id));
    }
}
