<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AuthController extends Controller {

	public function login()
	{
	    return \Socialize::with('facebook')->redirect();
	}

	public function redirectToProvider()
	{
	}

	public function handleProviderCallback()
	{
	    $user = \Socialize::with('facebook')->user();
	    dd($user);
	}

}
