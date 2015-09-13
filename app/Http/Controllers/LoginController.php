<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Login\SocialLogin;

use Exception;
use Illuminate\Http\Request;
use App\User;
use Auth;
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
        try {
            $user = User::where('uid', $facebookUser->id)->firstOrFail();
            Auth::login($user);
        } catch (Exception $e) {
            $this->dispatch(
                new \App\Commands\RegisterUser($facebookUser)
            );
        }
        return redirect(route('home'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }

}
