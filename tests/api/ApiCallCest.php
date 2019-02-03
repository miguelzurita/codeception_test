<?php

class ApiCallCest {
	public function _before( ApiTester $I ) {
		echo "_before( ApiTester I )\n";
	}

	public function _after( ApiTester $I ) {
		echo "_after( ApiTester I )\n";
	}

	// tests

	/**
	 * https://docs.postman-echo.com/
	 * @param ApiTester $I
	 */
	public function testPostCall( ApiTester $I ) {
		$I->amHttpAuthenticated( 'service_user', '123456' );
		$I->haveHttpHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
//		call service with parameteres
		$I->sendPOST( '/post', [ 'name' => 'davert', 'email' => 'davert@codeception.com' ] );
		$I->seeResponseCodeIs( \Codeception\Util\HttpCode::OK ); // 200
		$I->seeResponseIsJson();
		$I->seeResponseContains( '"name":"davert"' );
	}

	public function testJSONResponseProperty( ApiTester $I ) {
		echo "\n=>executing testJSONResponseProperty\n";
		$I->sendPOST( '/post', [ 'name' => 'davert', 'email' => 'davert@codeception.com' ] );
		$I->seeResponseIsJson();
		$I->seeResponseJsonMatchesJsonPath( '$json.name' );
//		get raw response
		$response = $I->grabResponse();
//		var_dump( $response );
//		convert to json object
		$json_response = json_decode( $response );
		echo "json_response->json->name:" . $json_response->json->name . "\n\n";
//		print_r( $response );
	}

	public function testGetCall( ApiTester $I ) {
		$I->amHttpAuthenticated( 'service_user', '123456' );
		$I->haveHttpHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
//		call service with parameteres
		$I->sendGET( '/get', [ 'foo1' => 'bar1', 'foo2' => 'bar2' ] );
		$I->seeResponseCodeIs( \Codeception\Util\HttpCode::OK ); // 200
		$I->seeResponseIsJson();
		$I->seeResponseContains( '"foo1":"bar1"' );
	}
}
