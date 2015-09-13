<?php

class GameCreateTest extends TestCase {

	public function test_admin_can_click_create_game_link()
	{
		$admin = factory(App\User::class)->create([
			'is_admin' => true
		]);
		$this->actingAs($admin);
		$this->visit('/')
			->click('Nytt')
			->seePageIs('/games/create');
	}

	public function test_user_cant_click_create_game_link()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);
		$this->visit('/')
			->dontSee('Nytt');
	}

	public function test_user_cant_visit_create_game_route()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);
		$this->visit('games/create')
			->seePageIs('/');
	}

}