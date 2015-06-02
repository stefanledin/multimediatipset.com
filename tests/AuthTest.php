<?php

class AuthTest extends TestCase {

	protected $baseUrl = 'http://multimediatipset.app';

    public function tearDown()
    {
        Mockery::close();
    }

	public function test_user_can_log_in()
	{
		$this->assertFalse(Auth::check());

        $socialLogin = Mockery::mock('App\Login\SocialLogin');
        $this->app->instance('App\Login\SocialLogin', $socialLogin);

        $socialLogin->shouldReceive('login')->once();
        $socialLogin->shouldReceive('handleCallback')->once()->andReturn((object) [
            'id' => '12345'
        ]);

        $this->visit('/login');
        $this->visit('/login/redirect');

        $this->assertTrue(Auth::check());
        $this->assertEquals('12345', Auth::user()->uid);
    }

    public function test_new_user_is_created()
    {
        $this->assertFalse(Auth::check());

        $socialLogin = Mockery::mock('App\Login\SocialLogin');
        $this->app->instance('App\Login\SocialLogin', $socialLogin);

        $socialLogin->shouldReceive('login')->once();
        $socialLogin->shouldReceive('handleCallback')->once()->andReturn((object)[
            'uid' => 'unknown'
        ]);

        $this->visit('/login');
        $this->visit('/login/redirect');

        $this->notSeeInDatabase('users', [
            'uid' => 'unknown'
        ]);
    }


}