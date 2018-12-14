<?php 

class CreateUserCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
    }

    public function createUserViaApi(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPOST('/register', ['name' => 'cocedepction', 'email' => 'davert@codeception.com', 'password' => '1234']);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        //$I->seeResponseContains('{"result":"ok"}');
    }
}
