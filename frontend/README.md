#Настройка окружения для разработки

Должен быть установлен docker. [Установить Docker](https://docs.docker.com/engine/installation/linux/docker-ce/ubuntu/#set-up-the-repository)

Один раз собираем image
```bash
cd frontend
sudo docker build -t pbblg/frontend .
```
и устанавливаем js зависимости
```bash
sudo docker run -it --rm -v=путь к папке pbblg/frontend:/home/app pbblg/frontend bash
yarn install
exit
```
В дальнейшем используем команды:

вначале поднимаем контейнер
```bash
sudo dockerun --name pbblg-frontend -v=`pwd`:/home/app -d -it --rm --network host pbblg/frontend
```
остановить контейнер
```bash
sudo dockecontainer stop pbblg-frontend
```

поднять сервер
```bash
sudo docker exec -it pbblg-frontend  bash -c "cd frontend && yarn start"
sudo docker exec -it pbblg-frontend  bash -c "cd frontend && yarn startTestServer"
```
сделать билд
```bash
sudo docker exec -it pbblg-frontend  bash -c "cd frontend && yarn build"
```