<?php

Route::get('/', ['as' => 'home', 'uses' => 'GamesController@index']);

Route::get('login', ['uses' => 'LoginController@login']);
Route::get('login/redirect', ['uses' => 'LoginController@handleFacebookCallback']);
Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);


Route::resource('games', 'GamesController');
Route::resource('predictions', 'PredictionsController');
