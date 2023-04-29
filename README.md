# Документация проекта Laravel-Blog-AdminPanel
Этот проект является веб-приложением, созданным на основе фреймворка Laravel. Он предназначен для создания и управления блогом. В проекте используется панель администратора, которая позволяет администратору управлять контентом блога.

## Требования к системе
Для запуска проекта необходимо наличие на локальном компьютере следующих инструментов:

- PHP 8.1 или выше
- MySQL
- Composer
- Node.js
- NPM

## Установка проекта
1. Склонируйте репозиторий в вашу локальную директорию: `git clone https://github.com/iWpoo/Laravel-Blog-AdminPanel.git`.
2. Перейдите в директорию проекта: `cd Laravel-Blog-AdminPanel`.
3. Установите зависимости, используя команду: `composer install`.
4. Установить зависимости с помощью NPM: `npm install` и `npm run dev`
5. Создайте копию файла .env.example и назовите ее .env: `cp .env.example .env`.
6. Создайте новый ключ приложения: `php artisan key:generate`.
7. Создайте базу данных и настройте файл .env с соответствующими настройками базы данных.
8. Выполните миграции, используя команду: `php artisan migrate`.
9. Запустите очередь обработки писем для корректной работы функций, связанных с почтой: `php artisan queue:work`
10. Запустите сервер, используя команду: `php artisan serve`.

После выполнения этих шагов проект будет доступен по адресу `http://localhost:8000`.

## Основные функции
### Аутентификация
Аутентификация в проекте осуществляется через встроенную систему аутентификации Laravel. Для входа в систему необходимо ввести свой email и пароль.

### Mailtrap
Для подтверждения пароля и других функций, связанных с почтой, проект использует сервис Mailtrap. При необходимости настройки данного сервиса необходимо обратиться к документации Mailtrap.

### Панель администратора
Панель администратора позволяет администратору управлять контентом блога. Администратор может создавать, редактировать и удалять категории и статьи блога. Также администратор может управлять пользователями системы.

### Категории блога
Администратор может создавать, редактировать и удалять категории блога. Каждая категория имеет название и описание.

### Статьи блога
Администратор может создавать, редактировать и удалять статьи блога. Каждая статья имеет заголовок, краткое описание, содержание, категорию и изображение.

### Пользователи системы
Администратор может просматривать список пользователей, удалять пользователей и изменять роли пользователей.

### Управление комментариями
Пользователь может оставлять комментарии к постам, а также удалять свои комментарии.

### Поиск постов
На главной странице и на странице "Posts" есть возможность выполнить поиск постов по ключевому слову. Для выполнения поиска необходимо ввести ключевое слово в поле поиска и нажать кнопку "Search".

## Используемые технологии
Проект Laravel-Blog-AdminPanel использует следующие технологии:

- Laravel
- Bootstrap 
- Font Awesome
- jQuery 
- Ajax
- Mailtrap 

## Заключение
Laravel-Blog-AdminPanel - это простое приложение на основе фреймворка Laravel, которое позволяет администраторам управлять блогом. Оно демонстрирует основные принципы разработки на Laravel, включая маршрутизацию, контроллеры, шаблоны, работу с базой данных и отправку почты.
