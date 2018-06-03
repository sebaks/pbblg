<?php

use Page\HomePage;
use Page\GameLobbyPage;

class OnlinePlayersListCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }


    public function tryToLoginAndSeeIamInOnlinePlayersList(AcceptanceTester $I)
    {
        $me = $I->amLoggedIn();

        $I->click(HomePage::$playButton);

        $I->seeInCurrentUrl(GameLobbyPage::$URL);
        $I->see($me->name, GameLobbyPage::$onlinePlayersList);
    }

    public function tryToSeeOtherPlayerInPlayersList(AcceptanceTester $I)
    {
        $me = $I->amOnGameLobby();


        $slavik = $I->haveFriend('Slavik');
        $slavik->does(function(AcceptanceTester $I) use ($me) {

            $me->slavik =  $I->amOnGameLobby();

            $I->see($me->name, GameLobbyPage::$onlinePlayersList);
        });

        $I->see($me->slavik->name, GameLobbyPage::$onlinePlayersList);

        $slavik->leave();
    }
}
