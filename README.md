# О проекте "Dictionary"

Проект задуман и реализован для изучения английских слов. Есть возможность добавлять, редактировать и удалять слова.
Каждое слово можно изучить в двух упражнениях, а также повторять не чаще 1 раза в сутки. За изучение и повторение слов
пользователю начисляется опыт. В дальнейшем планируется реализовать таблицу лидеров и систему добавления в друзья для 
сравнения своей статистики с другими пользователями.

Данный проект создан с использованием фреймворка Laravel версии 8.54.0, 
php 7.4, MySQL 8.0

# Установка

- Клонировать проект на свой компьютер командой "git clone https://github.com/V0LKINI/Dictionary-laravel.git"
- Установить composer (при использовании Open Server он уже установлен), в папке проекта выполнить команду 
  composer install. После установки появляется папка vendor, куда складываются установленные пакеты и формируется файл autoload.php
- Переименовать .env.example в .env и обновить его с вашими учетными данными базы данных
- Сгенерировать ключ приложения командой php artisan key:generate
- Запустить миграции базы данных командой php artisan migrate
- Наполнить базу данных содержимым php artisan db:seed
- Запустить проект при помощи php artisan serve, либо используя Open Server
- Войти на сайт, используя email: admin@example.com и пароль: admin

## Главная страница

![Main page](https://github.com/V0LKINI/Dictionary-laravel/blob/main/public/img/main.PNG)

## Страница с упражнением
![Exercise page](https://github.com/V0LKINI/Dictionary-laravel/blob/main/public/img/exercise.PNG)

## Результат упражнения
![Exercise results page](https://github.com/V0LKINI/Dictionary-laravel/blob/main/public/img/exercise_results.PNG)
