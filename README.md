# О проекте "Dictionary"

Проект задуман и реализован для изучения английских слов. Есть возможность добавлять, редактировать и удалять слова.
Каждое слово можно изучить в двух упражнениях, а также повторять не чаще 1 раза в сутки. За изучение и повторение слов
пользователю начисляется опыт. Вы можете искать редактировать свой профиль, добавлять в друзья других пользователей.

Данный проект создан с использованием фреймворка Laravel версии 8.54.0, 
php 7.4, MySQL 8.0

# Установка

- Клонировать проект на свой компьютер командой "git clone https://github.com/V0LKINI/Dictionary-laravel.git"
- Установить composer (при использовании Open Server он уже установлен), в папке проекта выполнить команду 
  composer install. После установки появляется папка vendor, куда складываются установленные пакеты и формируется файл 
  autoload.php
- Переименовать .env.example в .env и обновить его с вашими учетными данными базы данных
- Сгенерировать ключ приложения командой php artisan key:generate
- Запустить миграции и сиды базы данных командой php artisan migrate --seed
- Создать симлинк php artisan storage:link
- Запустить проект при помощи php artisan serve, либо используя Open Server
- Войти на сайт, используя email: admin@example.com и пароль: admin

## Главная страница

![Main page](https://github.com/V0LKINI/Dictionary-laravel/blob/main/public/img/mainPage.PNG)

## Страница с упражнением
![Exercise page](https://github.com/V0LKINI/Dictionary-laravel/blob/main/public/img/exercisePage.PNG)

## Результат упражнения
![Exercise results page](https://github.com/V0LKINI/Dictionary-laravel/blob/main/public/img/exerciseResultsPage.PNG)

## Страница с профилем
![Exercise page](https://github.com/V0LKINI/Dictionary-laravel/blob/main/public/img/profilePage.PNG)

## Страница с редактированием профиля
![Exercise results page](https://github.com/V0LKINI/Dictionary-laravel/blob/main/public/img/profileEditPage.PNG)
