<?php

use Page\RegisterPage;
use Page\HomePage;

class RegistrationCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }


    public function tryToRegisterUser(AcceptanceTester $I)
    {
        $I->amOnPage(HomePage::$URL);
        $I->click(HomePage::$registrationButton);

        $I->seeInCurrentUrl(RegisterPage::$URL);

        $I->fillField(RegisterPage::$usernameField, 'register-test-' . microtime(true));
        $I->fillField(RegisterPage::$passwordField, '1q2w3e4r');
        $I->fillField(RegisterPage::$passwordAgainField, '1q2w3e4r');
        $I->click(RegisterPage::$registerButton);

        $I->seeInCurrentUrl(HomePage::$URL);
        $I->seeElement(HomePage::$logoutButton);
        $I->dontSeeElement(HomePage::$loginButton);
    }
}
