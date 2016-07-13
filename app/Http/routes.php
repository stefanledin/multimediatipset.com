<?php

Route::get('/', ['as' => 'home', 'uses' => 'GamesController@index']);

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('game/new', ['as' => 'games.create', 'uses' => 'GamesController@create']);
    Route::post('game/new', ['as' => 'games.store', 'uses' => 'GamesController@store']);
    Route::get('game/{id}', ['as' => 'admin.games.edit', 'uses' => 'GamesController@edit']);
    Route::post('game/{id}', ['as' => 'games.update', 'uses' => 'GamesController@update']);

    Route::resource('questions', 'QuestionsController');
});

Route::get('games/{id}', ['as' => 'games.show', 'uses' => 'GamesController@show']);

Route::get('login', ['uses' => 'LoginController@login']);
Route::get('login/redirect', ['uses' => 'LoginController@handleFacebookCallback']);
Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

Route::get('users/{id}', ['uses' => 'UsersController@show']);
Route::post('users/{id}', ['uses' => 'UsersController@update']);

Route::resource('answers', 'AnswersController');
Route::resource('predictions', 'PredictionsController');
