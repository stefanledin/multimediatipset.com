<?php

class AuthTest extends TestCase {

	protected $baseUrl = 'http://multimediatipset.app';

	public function test_user_can_log_in()
	{
		$this->assertFalse(Auth::check());

        $socialLogin = Mockery::mock('App\Login\SocialLogin');
        $this->app->instance('App\Login\SocialLogin', $socialLogin);

        $socialLogin->shouldReceive('login')->once();
        $socialLogin->shouldReceive('handleCallback')->once()->andReturn([
            'uid' => '12345'
        ]);

        $this->visit('/login');
        $this->visit('/login/redirect');
    }

    public function tearDown()
    {
        Mockery::close();
    }

}