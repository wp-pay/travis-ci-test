<?php

class WebTest extends PHPUnit_Extensions_Selenium2TestCase {
	/**
	 * Setup
	 */
	protected function setUp() {
		$this->setBrowser( 'firefox' );
		$this->setBrowserUrl( 'http://localhost:8080/' );
	}

	public function testTitle() {
		$this->url( 'wp-admin' );

		$form = $this->byId( 'loginform' );

		$this->byId( 'user_login' )->value( 'test' );
		$this->byId( 'user_pass' )->value( 'test' );

 		$form->submit();

		$this->assertStringStartsWith( 'Dashboard', $this->title() );
	}
}
