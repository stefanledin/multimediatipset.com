<?php

Route::get('/', ['as' => 'home', 'uses' => 'GamesController@index']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('admin/game/new', 'GamesController@create');
    Route::post('admin/game/new', ['as' => 'games.store', 'uses' => 'GamesController@store']);
    Route::get('admin/game/{id}', ['as' => 'games.edit', 'uses' => 'GamesController@edit']);
    Route::post('admin/game/{id}', ['as' => 'games.update', 'uses' => 'GamesController@update']);
});

Route::get('login', ['uses' => 'LoginController@login']);
Route::get('login/redirect', ['uses' => 'LoginController@handleFacebookCallback']);
Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

Route::get('users/{id}', ['uses' => 'UsersController@show']);
Route::post('users/{id}', ['uses' => 'UsersController@update']);

Route::resource('predictions', 'PredictionsController');
