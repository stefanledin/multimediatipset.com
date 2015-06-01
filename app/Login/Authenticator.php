<?php namespace App\Login;

use Socialize;

class Authenticator {

    public function login()
    {
        return Socialize::with('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialize::with('facebook')->user();
        die(var_dump($user));
    }

}