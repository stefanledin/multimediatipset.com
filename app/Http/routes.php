<?php

use App\User;

Route::get('/', ['as' => 'home', 'uses' => 'GamesController@index']);

Route::get('login', ['uses' => 'LoginController@login']);
Route::get('login/redirect', ['uses' => 'LoginController@handleFacebookCallback']);

Route::resource('games', 'GamesController');
Route::resource('predictions', 'PredictionsController');
