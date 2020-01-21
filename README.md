# Сервис: отчеты по затраченному времени

[![Build Status](https://travis-ci.com/pugofka/simple-time-report.svg?branch=master)](https://travis-ci.com/pugofka/simple-time-report)
[![Known Vulnerabilities](https://snyk.io/test/github/pugofka/simple-time-report/badge.svg?targetFile=package.json)](https://snyk.io/test/github/pugofka/simple-time-report?targetFile=package.json)

Простой сервис по ведению еженедельных отчетов по затраченому времени.

## Технологии и версии

-   Laravel 5.7
-   PHP 7.2
-   MySQL 5.7
-   Node 8.10.0
-   Yarn 1.10.1

## Быстрый старт

1. Склонируйте код из репозитоия
2. Создайте конфигурацию проекта для текущей среды разработки `cp .env.example .env`
3. Настройте созданный файл конфигурации `.env`
4. Установите PHP зависимости командой `composer install`
5. Сгенерируйте уникальный ключ приложения командой `php artisan key:generate`
6. Сделайте миграцию баз данных командой `php artisan migrate`
7. Заполните БД стартовыми данными `php artisan db:seed`
8. Установить NPM зависимости `yarn`
9. Билдим фронт `yarn run prod`

## Автоматическое создание отчетов

Повесьте на _cron_ команду `php artisan schedule:run` чтобы своевременно запускать все _schedulers_

### Команды

_Schedulers_ запускаются командой `php artisan [schedule-task]` где _[schedule-task]_ название вашей задачи, например `php artisan report:create`

#### Список команд:

-   `report:create` - создание отчетов

## Дефолтный доступ в админку

-   **User:** info@pugofka.com
-   **Pass:** admin

## Тестирование

### Юнит-тесты

-   `npm run php-unit`

### JS-линтер

-   Запускаем `npm run js-lint`

### PHP-линтер

-   Запускаем проверку `npm run php-lint`
