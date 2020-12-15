<p align="center">
    <img src="public/assets/img/logo.png" width="125" height="32" alt="Unique">
</p>

# Учебный проект "Unique"

## О проекте

Проект "Unique" это учебный проект на `Laravel v.8` по созданию одностраничного сайта "landing page" на базе готового шаблона от WebThemez.com. Обычно такие сайты не предусматриваю наличие администраторской части (/admin), но с целью изучения встроенного механизма авторизации (через фасад Auth) и более полной работы с моделями данных (создание, обновление, удалени) дополнительно создана админ.часть на библиотеке `Bootstrap v4.5`.

В связи с тем, в что в Laravel 8, службы аутентификации предоставляеются пакетам Jetstream и Fortify, админ.часть не предусматривает управление пользователями, кроме как регистрации, аутентификации и завершении сеанса, функционал которых создан самостоятельно. Также не предусмотрено управление ролями и доступом к различным секциям панели управления и правами на операции, в связи чем любой авторизованный пользователь имеет полный доступ к любым действиям, что в реальном проекте конечно не допустимо.


## Установка

### 1. Клонируйте или создайте новый проект.
```shell
git clone git@github.com:Avxodiar/unique.git
```
или

```shell
composer create-project Avxodiar/unique
```

### 2. Создайте и настройте основную настройку проекта

Скопируйте файл `env.example` в `.env`
```shell
cp .env.example .env
```

Измените файл `.env` и установите настройки соединения с БД `database` для вашей системы.

Там же настройте почтовую службу, а затем задайте почтовый адрес и имя для получения сообщений из формы "Контакты" сайта.
```
MAIL_MANAGER=your-mail-manager@address
MAIL_MANAGER_NAME=Dr.Strange
```

### 2. Установите необходимые пакеты и зависимости 

```shell
composer install -vvv
```

### 3. Создание таблиц в указанной в `.env` БД.

```shell
php artisan migrate
```

Подготовьте к загрузке данные проекта, изменив их в файлах `PagesSeeder.php`, `PeoplesSeeder.php`, `PortfoliosSeeder.php`, `ServicesSeeder.php` в каталоге `/database/seeders`, или воспользуйтесь уже имеющимися в них тестовыми данными.

Загрузите в созданные ранее таблицы тестовые данные.
```shell
php artisan db:seed
```

## Системные требования

 - PHP >= 7.3
 - PDO PHP Extension
 - Tokenizer PHP Extension
 - Ctype PHP Extension
 - Mbstring PHP Extension
 - JSON PHP Extension
 - Fileinfo PHP extension
 - BCMath PHP Extension
 - OpenSSL PHP Extension
 - XML PHP Extension 
