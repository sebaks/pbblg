# pbblg
Princess Bubblegum game.

[![Build Status](https://travis-ci.org/pbblg/pbblg.svg?branch=master)](https://travis-ci.org/pbblg/pbblg)
[![Coverage Status](https://coveralls.io/repos/github/pbblg/pbblg/badge.svg?branch=master)](https://coveralls.io/github/pbblg/pbblg?branch=master)

## Комманды
`$ composer serve` - запускает РНР сервер. Сервер доступен на http://localhost::8080.

`$ ./bin/websocket` - запускает Websocket сервер. Сервер доступен на http://localhost::8088. (См. консоль и исходный код индексной страницы)

`$ vendor/bin/cghooks add --ignore-lock` - Устанавливает pre-commit git hook.

## Темплит админки

Используем [AdminLTE](https://adminlte.io/docs/2.4/layout) шаблон для админки, чтобы его увидеть, нужно выполнить

```bash
ln -s /home/maxgu/proj/pbblg/vendor/almasaeed2010/adminlte/ /home/maxgu/proj/pbblg/public/
```

т.е. создать символическую ссылку с полными путями.
Тепрь шаблон можно видеть по адресу `http://localhost:8080/adminlte/index.html`.

(А у кого виндоуз, то можно просто скопировать папку adminlte в public). 


## Запуск тестов

поднять контеинер c selenium
```bash
sudo docker run --name selenium-server -p 4444:4444 -v /dev/shm:/dev/shm -d -it --rm --network host  selenium/standalone-chrome
```

запустить тесты
```bash
./vendor/bin/codecept run
```