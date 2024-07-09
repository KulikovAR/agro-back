<p align="center"><a href="https://static.tildacdn.com/tild3731-3932-4564-a231-666132316666/Logo.svg" target="_blank"><img src="https://static.tildacdn.com/tild3731-3932-4564-a231-666132316666/Logo.svg" width="400" alt="Laravel Logo"></a></p>

Инструкция по развёртыванию приложения

1. Скопировать из .env.example переменные и вставить в свой .env

2. В директории склонированного репозитория ввести команду docker-compose up -d --build

3. Войти в контейнер с приложением docker exec -it agro-app bash

4. Изнутри запустить composer install (если не сработает - composer update)

5. Заполнить базу данных командой (всё ещё внутри контейнера) php artisan migrate:fresh --seed

