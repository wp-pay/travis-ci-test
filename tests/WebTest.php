<?php

class WebTest extends PHPUnit_Extensions_Selenium2TestCase {
	protected function setUp() {
		$this->setBrowser( 'firefox' );
		$this->setBrowserUrl( 'http://localhost:8080/' );
	}

	public function testTitle() {
		$this->url( 'http://localhost:8080/' );

		$this->open( '/wp-admin/' );

		$this->type( 'id=user_login', 'test' );
		$this->type( 'id=user_pass', 'test' );

		$this->click( 'id=wp-submit' );

		$this->waitForPageToLoad( '30000' );

		$this->assertStringStartsWith( 'Dashboard', $this->title() );
	}
}
