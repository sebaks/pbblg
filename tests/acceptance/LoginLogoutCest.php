<?php

use Page\LoginPage;
use Page\HomePage;

class LoginLogoutCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }


    public function tryToLoginAndLogout(AcceptanceTester $I)
    {
        $user = $I->haveUser();

        $I->amOnPage(HomePage::$URL);
        $I->dontSeeElement(HomePage::$logoutButton);
        $I->click(HomePage::$loginButton);

        $I->seeInCurrentUrl(LoginPage::$URL);

        $I->fillField(LoginPage::$usernameField, $user->name);
        $I->fillField(LoginPage::$passwordField, $user->password);
        $I->click(LoginPage::$loginButton);

        $I->seeInCurrentUrl(HomePage::$URL);
        $I->seeElement(HomePage::$logoutButton);
        $I->dontSeeElement(HomePage::$loginButton);

        $I->click(HomePage::$logoutButton);
        $I->seeInCurrentUrl(HomePage::$URL);

        $I->seeElement(HomePage::$loginButton);
        $I->dontSeeElement(HomePage::$logoutButton);
    }
}
