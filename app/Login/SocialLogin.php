<?php namespace App\Login;

use Socialize;

class SocialLogin {

    public function login()
    {
        return Socialize::with('facebook')->redirect();
    }

    public function handleCallback()
    {
        return Socialize::with('facebook')->user();
    }

}
