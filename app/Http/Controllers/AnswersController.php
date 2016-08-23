<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Answer;
use App\Question;
use \Auth;
use App\Http\Requests\StoreAnswerRequest;

class AnswersController extends Controller
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
        // new AnswerValidator
        // new StoreAnswer( $request->input('all') );
        $validation = new AnswerValidator($request->input('question_type'));
        $validation->rules
        $validation->messages
        $this->validate($request, $validation->rules, $validation->messages);

        if ($request->get('question_type') == 'Score') :
            $rules = [];
            foreach ($request->get('answer') as $questionID => $value) {
                $rules['answer.'.$questionID] = 'required';
            }
            $messages = [];
            foreach ($request->get('answer') as $questionID => $value) {
                $question = Question::find($questionID);
                $messages['answer.'.$questionID.'.required'] = 'Tipset för '.$question->title.' saknas';
            }
            $this->validate($request, $rules, $messages);
        else :
            $question = Question::find($request->get('question_id'));
        endif;

        $user = Auth::user();
        
        $answers = $request->input('answer');
        foreach ($answers as $questionID => $answer) {
            $answer = new Answer([
                'answer' => str_replace(' ', '', $answer)
            ]);
            $question = Question::find($questionID);
            $question->answers()->save($answer);
            $user->answers()->save($answer);
        }

        return redirect(route('games.show', $request->input('game_id')));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
