<?php

class UserSettingsTest extends TestCase {

	public function test_user_can_change_username()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);

		$this->visit('/')
			->click($user->username)
			->seePageIs('users/'.$user->id)
			->see('Hej '.$user->username.'!')
			->type('PewDiePie', 'username')
			->press('Spara')
			->seePageIs('users/'.$user->id)
			->see('Hej PewDiePie!');

		$this->assertEquals('PewDiePie', App\User::find($user->id)->username);
	}

}