<?php

Route::get('/', ['as' => 'home', 'uses' => 'GamesController@index']);

Route::get('login', ['uses' => 'LoginController@login']);
Route::get('login/redirect', ['uses' => 'LoginController@handleFacebookCallback']);
Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

Route::get('users/{id}', ['uses' => 'UsersController@show']);
Route::post('users/{id}', ['uses' => 'UsersController@update']);

Route::resource('games', 'GamesController');
Route::resource('predictions', 'PredictionsController');
