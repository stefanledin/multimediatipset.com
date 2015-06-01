<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Login\SocialLogin;

use Illuminate\Http\Request;
use Socialize;

class LoginController extends Controller {

    protected $socialLogin;

    function __construct(SocialLogin $socialLogin)
    {
        $this->socialLogin = $socialLogin;
    }

    public function login()
    {
        return $this->socialLogin->login();
    }

    public function handleFacebookCallback()
    {
        $facebookUser = $this->socialLogin->handleCallback();
        #die(var_dump($facebookUser));
    }


}
