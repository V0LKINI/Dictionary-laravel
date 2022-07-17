# О проекте "Dictionary"

Проект задуман и реализован для изучения английских слов, в дальнейшем добавилась страница с правилами грамматики.
Есть возможность добавлять, редактировать и удалять слова.
Каждое слово можно изучить в упражнениях, а также повторять не чаще 1 раза в сутки. За изучение и повторение слов
пользователю начисляется опыт. Вы можете редактировать свой профиль, добавлять в друзья других пользователей.

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
![Home page top](http://joxi.ru/Grq3eqEczX1Nk2.jpg)

![Home page bottom](http://joxi.ru/52aoQKOHlP691r.jpg)

## Словарь
![Dictionary](http://joxi.ru/v299JwEi41EG92.jpg)

## Страница с правилами грамматики
![Exercise results page](http://joxi.ru/Vm6pbwMt3wBVPA.jpg)

## Страница со списком упражнений
![Exercise list page](http://joxi.ru/EA4EpwqiXgdPyr.jpg)

## Страница упражнения
![Exercise page](http://joxi.ru/DmB6EdaiqEXdlm.jpg)

## Результат упражнения
![Exercise results page](http://joxi.ru/82Qy78gc8LPDJ2.jpg)

## Таблица лидеров
![leaderboard page](http://joxi.ru/8AnZ08McN5B1DA.jpg)

## Страница с профилем
![Exercise page](http://joxi.ru/L21Mjw8twPXGe2.jpg)

## Панель администратора
![Admin panel](http://joxi.ru/zANx51Nt14blBm.jpg)

## Тёмная тема на старнице словаря
![Dark theme](http://joxi.ru/n2YGzEWCkqYj1r.jpg)

## Английский язык интерфейса
![English interface](http://joxi.ru/Vm6pbwMt3wBxPA.jpg)
