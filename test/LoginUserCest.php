<?php 


class LoginUserCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
    }

    public function loginUserViaApi(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPOST('/login', ['name' => 'cocedepction', 'email' => 'davert@codeception.com', 'password' => '1234']);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $response = $I->grabResponse();

        $data = json_decode($response, true);
    }
}
