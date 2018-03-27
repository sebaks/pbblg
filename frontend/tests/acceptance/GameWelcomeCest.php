<?php


class GameWelcomeCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToEnterAndExitToGameWelcome(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->seeElement('.game-enter');

        $I->fillField('.game-enter-input-login', 'john.silver');
        $I->fillField('.game-enter-input-password', '1q2w3e4r');
        $I->click('.game-enter-submit-button');

        $I->waitForElement('.game-welcome');
        $I->see('You are: John Silver', '.game-welcome-menu-player-name');
        $I->seeElement('.game-welcome-menu-exit-button');

        $I->click('.game-welcome-menu-exit-button');
        $I->waitForElement('.game-enter');
    }
}
