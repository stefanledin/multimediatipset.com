<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Login\SocialLogin;

use Exception;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Socialize;
use App\User;
use Auth;

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
<<<<<<< Updated upstream
        try {
            $user = User::where('uid', $facebookUser->uid)->firstOrFail();
            if ($user) {
                Auth::login($user);
            }
        } catch (Exception $e) {
            
        }
=======
        $user = User::where('uid', $facebookUser->id)->get();
        Auth::login($user);
        #die(var_dump($facebookUser));
>>>>>>> Stashed changes
    }


}
