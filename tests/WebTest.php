<?php

class WebTest extends PHPUnit_Extensions_Selenium2TestCase {
	protected function setUp() {
		$this->setBrowser( 'firefox' );
		$this->setBrowserUrl( 'http://localhost:8080/' );
	}

	public function testTitle() {
		$this->url( 'http://localhost:8080/' );
		$this->assertEquals( 'Test | Just another WordPress site', $this->title() );
	}
}
