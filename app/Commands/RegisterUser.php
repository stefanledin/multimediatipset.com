<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

use App\User;
use Auth;

class RegisterUser extends Command implements SelfHandling {

	protected $userData;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($userData)
	{
		$this->userData = $userData;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$user = User::create([
    		'uid' => $this->userData->id,
    		'username' => $this->userData->name,
    		'first_name' => $this->userData->user['first_name'],
    		'last_name' => $this->userData->user['last_name'],
    		'is_admin' => 0
		]);
		Auth::login($user);
	}

}
