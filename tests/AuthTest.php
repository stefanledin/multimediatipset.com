<?php

class AuthTest extends TestCase {

	protected $baseUrl = 'http://multimediatipset.app';

	public function test_user_can_log_in()
	{
		$this->assertFalse(Auth::check());
		$this->visit('/login');
	}

}