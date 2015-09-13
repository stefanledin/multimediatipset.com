<?php namespace App\Login;

use Socialize;

class SocialLogin {

    public function login()
    {
        return Socialize::driver('facebook')->redirect();
    }

    public function handleCallback()
    {
        return Socialize::driver('facebook')->user();
    }

}
