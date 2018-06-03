<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /**
     * @return UserDTO
     */
    public function haveUser()
    {
        $user = new UserDTO;

        $user->name = 'auto-tester-' . microtime(true);
        $user->password = '$2y$10$jXYjn9kh3pasjX1xvthUuuybpsbps4K.T4UQOJGq/DiRFN3Sev1tG';
        $id = $this->haveInDatabase('users', $user->toArray());

        $user->id = $id;
        $user->password = '1q2w3e4r';

        return $user;
    }

    /**
     * @return UserDTO
     */
    public function amLoggedIn()
    {
        $user = $this->haveUser();

        $this->amOnPage(\Page\LoginPage::$URL);
        $this->submitForm(\Page\LoginPage::$loginForm, [
            \Page\LoginPage::$usernameFieldName => $user->name,
            \Page\LoginPage::$passwordFieldName => $user->password,
        ]);
        $this->waitForElement('#home-header');

        return $user;
    }

    /**
     * @return UserDTO
     */
    public function amOnGameLobby()
    {
        $user = $this->amLoggedIn();

        $this->amOnPage(\Page\GameLobbyPage::$URL);
        $this->waitForElement('#game-lobby');

        return $user;
    }
}

class UserDTO
{
    public $id;
    public $name;
    public $password;

    public function toArray()
    {
        return get_object_vars($this);
    }
}
