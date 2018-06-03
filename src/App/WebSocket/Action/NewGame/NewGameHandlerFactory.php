<?php

namespace App\WebSocket\Action\NewGame;

use Psr\Container\ContainerInterface;
use App\WebSocket\Client;

class NewGameHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new NewGameHandler(
            $container->get('Game\Infrastructure\Repository'),
            $container->get('UsersInGames\Infrastructure\Repository'),
            $container->get(Client::class)
        );
    }
}
