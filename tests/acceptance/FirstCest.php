<?php

class FirstCest {
	public function _before( AcceptanceTester $I ) {
	}

	// tests

	/**
	 * "./vendor/bin/codecept" run --steps
	 *
	 * @param AcceptanceTester $I
	 */
	public function tryToTest( AcceptanceTester $I ) {
		$I->amOnPage( "/" );
		$I->see( "Which Postman Plan Will Deliver for You?" );
		$I->see( "Postman, Inc." );
	}
}
