<?php

use App\User;

Route::get('/', ['as' => 'home', 'uses' => 'GamesController@index']);
Route::get('login', ['uses' => 'AuthController@login']);
Route::get('login/redirect', ['uses' => 'AuthController@handleProviderCallback']);
Route::resource('games', 'GamesController');
Route::resource('predictions', 'PredictionsController');
