<?php

class AuthTest extends TestCase {

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
            'id' => '12345',
            'name' => 'Stefan Ledin',
            'avatar' => 'http://lorempixel.com/100/100/',
            'avatar_original' => 'http://lorempixel.com/557/557/',
            'user' => array(
                'first_name' => 'Stefan',
                'last_name' => 'Ledin'
            )
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
            'id' => '00000',
            'name' => 'John Doe',
            'avatar' => 'http://lorempixel.com/100/100/',
            'avatar_original' => 'http://lorempixel.com/557/557/',
            'user' => array(
                'first_name' => 'John',
                'last_name' => 'Doe'
            )
        ]);

        $this->notSeeInDatabase('users', [
            'uid' => '00000',
        ]);

        $this->visit('/login');
        $this->visit('/login/redirect');

        $this->seeInDatabase('users', [
            'uid' => '00000',
            'profile_picture' => 'http://lorempixel.com/557/557/',
            'profile_picture_thumbnail' => 'http://lorempixel.com/100/100/'
        ]);

        $this->assertTrue(Auth::check());
        $this->assertEquals('00000', Auth::user()->uid);
    }

    public function test_user_can_log_out()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);

        $this->assertTrue(Auth::check());

        $this->visit('/')
            ->click('Logga ut');

        $this->assertFalse(Auth::check());
    }


}