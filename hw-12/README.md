# Продвинутое программирование на PHP — Laravel
## Урок 12. Интеграция с внешними сервисами
### Домашнее задание
<br><br>
Цели практической работы:<br>

Научиться:<br>

— интегрировать отправку писем через почтового клиента;<br>
— настраивать отправку сообщений в мессенджер.<br>

Что нужно сделать:<br>

В этой практической работе вы реализуете уведомления через внешние сервисы.<br>

1. Создайте новый проект Laravel или откройте уже существующий.

2. Создайте новую ветку вашего репозитория от корневой (main или master).

3. Настройте регистрацию и аутентификацию пользователей.

4. Настройте почтовый клиент любого сервиса.

5. Впишите в файл .env нужные значения для почтового сервиса.

6. Создайте письмо Welcome.php командой php artisan make:mail Welcome.

7. В конструкторе класса присвойте свойству класса $user параметр конструктора класса.

```
public User $user;
public function __construct(User $user)
{
$this->user = $user;
}
```

8. Создайте шаблон мейлинга welcome.blade.php в директории resources/views/emails с кодом внутри

```
Добрый день,
{
{ $user -> name }
},
спасибо за регистрацию.
```

9. Добавьте код отправки вашего письма в функцию store класса RegisteredUserController.

10. Подключите клиент мессенджера Telegram командой composer require irazasyed/telegram-bot-sdk

11. Создайте бота и канал, добавьте бота в телеграм-канал.

12. Укажите в файле .env значения, необходимые для работы бота.

13. Проверьте работу бота с помощью тестового маршрута.

```
Route::get('test-telegram', function () {
Telegram::sendMessage([
'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
'parse_mode' => 'html',
'text' => 'Произошло тестовое событие'
]);
return response()->json([
'status' => 'success'
]);
});
```

14. Добавьте код уведомления в мессенджер о новом пользователе вашей системы в функцию store класса RegisteredUserController.

15. Зарегистрируйтесь на сайте.

16. Проверьте, что сообщение отправлено на электронную почту (рекомендуется использовать для регистрации тот почтовый ящик, с которого отправляется сообщение, чтобы избежать блокировки адреса за спам).

17. Проверьте, что в Telegram пришло уведомление о регистрации нового пользователя.

##
## Домашнее задание

Открыть терминал и перейти в папку с уроком:
```
cd hw-12
```

<br>


#### Для работы отправки почтового сообщения в работающем приложении нужно запустить или перезапустить воркер

В готовом проекте перейти в папку с приложением:
```bash
cd hw-12
```
```bash
cd twelfth-laravel-app
```
Запустить (перезапустить) воркер:
```bash
  php artisan queue:restart
```
```bash
  php artisan queue:work
```
>И проверять, что есть таблица для фейлов:
>
>```bash
>  php artisan queue:failed-table
>  php artisan migrate
>```
- Запустить сервер Laravel:
```bash
  php artisan serve
```
- Проверить, что регистрация и вход работают в браузере по адресу: http://127.0.0.1:8000/


<br>



## Инструкция
### 1. Создать новый проект Laravel

- Открыть терминал и выполнить команду:
```
laravel new twelfth-laravel-app
```

- Перейти в директорию проекта:
```
cd twelfth-laravel-app
```
- В корне проекта выполнить, эта команда сгенерирует новый ключ в проект, пропишет его в .env, в строке вида `APP_KEY=base64:..`:

``` 
php artisan key:generate
```

<br>

### 2. Создать новую ветку репозитория

- Инициализировать git:
```
git init
```
- Создать и переключиться на новую ветку:
```
git checkout -b feature/notifications
```

<br>

### 3. Настроить регистрацию и аутентификацию

- Установить `библиотеку Breeze`:
```
composer require laravel/breeze
```

- Установить компоненты Breeze:
```
php artisan breeze:install
```
**При установке на вопрос `Which Breeze stack would you like to install?` ответить, установить - Blade with Alpine `blade`.**

- Установить зависимости (фронтенд-зависимости в данном случае):
```
npm install
```
- И собрать проект:
```
npm run dev
```

- Открыть новый терминал, перейти в проект:
```
cd hw-12/twelfth-laravel-app
```

- И выполнить миграции:
```
php artisan migrate
```

- Запустить сервер Laravel:
```
php artisan serve
```
- Проверить, что регистрация и вход работают в браузере по адресу: http://127.0.0.1:8000/

<br>

### 4. Настроить почтовый клиент

- Выбрать почтовый сервис, например, [Mail](#mail), [Mailtrap](#mailtrap), [Gmail](#gmail), [SMTP сервера](#smtr)
- Получить данные для настройки почтового подключения
  
<br>

### 5. Указать значения в файле окружения

- Открыть файл `.env` и вписать параметры почтового сервера, например:

```
MAIL_MAILER=smtp
MAIL_HOST=host
MAIL_PORT=port
MAIL_USERNAME=login
MAIL_PASSWORD=password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="Laravel App"
```

- Сохранить файл.
- После правки очистить кэш конфигурации:

```bash
php artisan config:clear
php artisan cache:clear
```
  
<br>

### 6. Создать письмо Welcome

Выполнить команду:
```
php artisan make:mail Welcome
```

<br>

### 7. Добавить свойство и конструктор в класс письма

Открыть файл `app/Mail/Welcome.php` и добавить функцию:

```
use App\Models\User;

public User $user;

public function __construct(User $user)
{
    $this->user = $user;
}
```

<br>

### 8. Создать шаблон письма

Создать файл `welcome.blade.php` в директории `resources/views/emails` и добавить код:

```
Добрый день,  
{{ $user->name }},  
спасибо за регистрацию.
```

<br>

### 9. Добавить отправку письма в контроллер регистрации

Открыть файл `app/Http/Controllers/Auth/RegisteredUserController.php`, в метод store добавить строку после создания пользователя:

```
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;

Mail::to($user->email)->send(new Welcome($user));
```

<br>

### 10. Установить клиент Telegram (Telegram SDK)

Выполнить команду:
```
composer require irazasyed/telegram-bot-sdk
```
<br>

### 11. Создать Telegram-бота и канал

1. Перейти в Telegram
2. Открыть BotFather
3. Создать нового бота и получить (токен) `TOKEN`
4. Создать канал
5. Добавить бота в канал и назначить его администратором
   
<br>

### 12. Указать данные в файле .env

Добавить параметры:
```
TELEGRAM_BOT_TOKEN=токен_бота
TELEGRAM_CHANNEL_ID=@имя_канала
```

<br>

### 13. Проверить работу Telegram-бота

- Открыть `routes/web.php` и добавить маршрут:
```
use Telegram\Bot\Laravel\Facades\Telegram;

Route::get('test-telegram', function () {
    Telegram::sendMessage([
        'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
        'parse_mode' => 'html',
        'text' => 'web.php: Произошло тестовое событие в /test-telegram'
    ]);
    return response()->json([
        'status' => 'success'
    ]);
});
```

- Перейти в браузере по адресу [http://localhost:8000/test-telegram](http://localhost:8000/test-telegram)
``` 
{
  "status": "success"
}
```
- Проверить, что сообщение пришло и появилось в Telegram-канале:
  
<br>

Быстрая проверка Telegram-канала:
Указать в .env цифровой id, для этого добавить себя в канал, если ещё нет, переслать любое сообщение канала в @userinfobot или @getidsbot, где они покажут chat id. Взять значение -100…, прописать в .env как `TELEGRAM_CHANNEL_ID=-100XXXXXXXXXXXX` и очистить кеши последовательно в редакторе кода:
``` 
php artisan config:clear 
php artisan cache:clear
php artisan route:clear
```
Или в консольной программе на ПК в корневой директории проекта:
``` 
php artisan config:clear && php artisan cache:clear && php artisan route:clear
```
Проверь отправку открыв команду:
``` 
php artisan tinker
```
В открывшемся окне терминала указать:
```
use Telegram\Bot\Laravel\Facades\Telegram;
Telegram::sendMessage(['chat_id' => env('TELEGRAM_CHANNEL_ID'), 'text' => 'Ping из tinker']);
```
Открыть http://localhost:8000/test-telegram, там должно быть status: ok.
``` 
{
  "status": "ok",
  "result": {
    "message_id": 41,
    "sender_chat": {
      "id": ...
```


### 14. Добавить отправку Telegram-сообщения при регистрации

В файле `RegisteredUserController.php`, в метод `store` после строки с отправкой письма добавить:

```
Telegram::sendMessage([
    'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
    'parse_mode' => 'html',
    'text' => 'Новый пользователь зарегистрирован: ' . $user->name
]);
```

<br>


### 15. Зарегистрироваться на сайте

- Открыть терминал в корне проекта и запустить встроенный сервер Laravel, если ещё не запущен. 
  По умолчанию приложение будет доступно по адресу [http://localhost:8000](http://localhost:8000):
```
php artisan serve
```
- Перейти на сайт. На главной странице должна быть доступна ссылка или кнопка `Register` (Регистрация).
- Зарегистрировать нового пользователя:
  - Нажать на ссылку Register.
  - В открывшейся форме заполнить поля:

     - Name** - ввести имя пользователя
     - Email - ввести действующий адрес электронной почты, на который будет отправлено письмо
     - Password - ввести надёжный пароль
     - Confirm Password - повторно ввести тот же пароль для подтверждения
  - Нажать кнопку `Register` для отправки формы. После успешной регистрации должно произойти перенаправление на главную страницу сайта или в личный кабинет. В этот момент будет выполнено следующее:

     - Пользователь будет автоматически аутентифицирован
     - На указанный адрес электронной почты будет отправлено приветственное письмо (если правильно настроен почтовый клиент)
     - В Telegram-канал будет отправлено уведомление о новом пользователе<br><br>

- Если регистрация прошла успешно, но почта или Telegram не сработали, необходимо вернуться к шагам 4–14 и проверить настройки сервиса отправки писем и параметров Telegram-бота.
- Если при регистрации возникла ошибка, открыть консоль браузера (F12 -> вкладка Console) и лог Laravel в файле `storage/logs/laravel.log`, чтобы найти описание ошибки. Также убедиться, что все миграции выполнены, зависимости установлены, а почтовая и Telegram-конфигурации корректны.

<br>

### 16. Проверить получение письма

- Проверить, что на указанный адрес пришло письмо
- Использовать адрес почтового ящика, совпадающий с адресом отправителя

![welcome email](../archives/hw-12-email.jpg)

<br>

### 17. Проверить сообщение в Telegram

- Проверить, что в канал отправлено уведомление о регистрации пользователя.

-Если в сети обязателен прокси, передать его Guzzle, опубликовать конфиг пакета командой:
``` 
php artisan vendor:publish --provider="Telegram\Bot\Laravel\TelegramServiceProvider"
```
- Проверить доступ бота к каналу, где бот должен быть админом канала, запустив команду:

```bash
curl "https://api.telegram.org/bot<ТОКЕН>/getChat?chat_id=@имя_канала"
```
Если ответ OK — возьми id из ответа (будет вида -100xxxxxxxxxx) и используй цифровой ID вместо @имя_канала — так надёжнее.

- Появится `config/telegram.php`. 
- Настроить через контейнер Guzzle/клиент SDK. В `app/Providers/AppServiceProvider.php` (метод register) можно принудительно подсунуть клиент с таймаутами/прокси:
```
use GuzzleHttp\Client as GuzzleClient;
use Telegram\Bot\TelegramClient;

public function register(): void
{
$this->app->bind(TelegramClient::class, function () {
return new TelegramClient(new GuzzleClient([
'timeout'         => 15,
'connect_timeout' => 5,
// 'proxy' => env('TELEGRAM_PROXY'), // http://user:pass@host:port
// 'verify' => true, // не выключай без необходимости
]));
});
}

```

- В .env при необходимости записать:
``` 
TELEGRAM_PROXY=http://user:pass@proxy-host:3128
```


После изменений:

``` 
php artisan config:clear
php artisan cache:clear
```
Сообщение при регистрации нового пользователя, которое отправляет подключенный к проекту бот в telegram-канал:

![telegram](../archives/hw-12-telegram.jpg)

<br>

### 18. Создать коммит

При необходимости по окончанию работы, оформить финальный коммит и отправить изменения в удалённый репозиторий.

<br><br>

<h2 id="gmail">Настройка почтового клиента Laravel через Gmail</h2> 
<br>

### 1. Включить доступ к почте через Gmail

Google не позволяет напрямую использовать пароль от аккаунта в сторонних приложениях, поэтому нужно создать специальный пароль для самого приложения.

1. Войти в Google-аккаунт в браузере:
   [https://myaccount.google.com/](https://myaccount.google.com/)
2. Перейти в раздел Безопасность.
3. Убедиться, что включена двухфакторная аутентификация (2FA), так как без двухфакторной аутентификации Google не позволит создать пароль приложения.
4. После включения 2FA найти раздел Пароли приложений.
5. Выбрать:
  - Приложение: Почта
  - Устройство: Другое -> ввести, например, `LaravelApp`
6. Нажать Создать.
7. Скопировать сгенерированный 16-значный пароль, так как этот пароль понадобится записать в `.env`. Пароль приложения должен быть 16 символов без пробелов и без кавычек. Исправить так - просто убрать пробелы и кавычки.

<br>

### 2. Заполнить `.env` в Laravel

Открыть `.env` в корне проекта и добавить или изменить параметры:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="Laravel App"
```

<br>

### 3. Проверить работу

Выполнить команду для теста:

```bash
php artisan tinker
```

В tinker ввести:

```
use Illuminate\Support\Facades\Mail;

Mail::raw('Тестовое письмо из Laravel', function($message) {
    $message->to('адрес_получателя@example.com')->subject('Проверка Gmail');
});
```

Если всё настроено правильно - письмо придёт на указанный адрес.

<br>

### 4. Как не публиковать данные на GitHub

1. Не коммитить файл `.env` - в Laravel, он уже добавлен в `.gitignore`.
2. Если хранить данные в `.env.example`, указывать без секретов, например:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_gmail_address
MAIL_PASSWORD=your_gmail_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_gmail_address
MAIL_FROM_NAME="Laravel App"
```

3. Все реальные данные: только в локальном `.env`, на сервере - в `.env` сервера.

<br>

### 5. Дополнительная защита аккаунта

Требования:
- Никогда не использовать основной пароль Google - только пароль приложения.
- При утечке пароля приложения можно удалить его в настройках Google без смены пароля всего аккаунта.
- Использовать 2FA всегда.
- Следить за активными сессиями и устройствами в аккаунте Google.

<br>

<h2 id="mail">Настройка почтового клиента Laravel через Mail</h2>

В Laravel под Mail обычно понимается стандартный почтовый транспорт, который может использовать локальный почтовый сервер (sendmail, postfix и т.п.) или интегрироваться с любым SMTP. <br>
Если настроить именно Mail в чистом виде, то есть локальную отправку писем через системный почтовый агент, то данные подключения берутся не с какого-то внешнего сайта, а из конфигурации сервера.

<br>

### 1. Mail в Laravel

- В `.env` при `MAIL_MAILER=sendmail` Laravel использует установленный в системе почтовый агент (sendmail или аналог).
- Для Windows этот способ не работает «из коробки» - требуется или внешний SMTP, или установка почтового сервера вручную.
- На Linux-серверах, например, Ubuntu, Debian, CentOS часто уже установлен sendmail или postfix.

<br>

### 2. Как получить данные подключения

#### Для локальной разработки

Если почтовый агент установлен:

- MAIL\_MAILER- `sendmail`
- MAIL\_HOST, MAIL\_PORT, MAIL\_USERNAME, MAIL\_PASSWORD - не используются
- MAIL\_FROM\_ADDRESS - e-mail, например, `no-reply@myapp.test`
- MAIL\_FROM\_NAME - имя отправителя, например, `My Laravel App`

Пример `.env`:

```
MAIL_MAILER=sendmail
MAIL_FROM_ADDRESS=no-reply@myapp.test
MAIL_FROM_NAME="My Laravel App"
```

Проверить наличие sendmail:

```bash
  which sendmail
```

Если команда вернёт путь, почтовый агент есть.

<br>

#### Для сервера с доступом к SMTP

Если используется внешний SMTP (например, хостинг-провайдер или корпоративный почтовый сервер):

- Эти данные выдаёт администратор почтового сервера или указаны в панели управления хостингом.
- Обычно нужны:
  - SMTP-хост, например, `mail.example.com`
  - Порт - обычно 587 для TLS или 465 для SSL
  - Логин или адрес почты, например, `support@example.com`
  - Пароль - устанавливается в панели хостинга
  - Шифрование `tls` или `ssl`

Пример `.env`:

```
MAIL_MAILER=smtp
MAIL_HOST=mail.example.com
MAIL_PORT=587
MAIL_USERNAME=support@example.com
MAIL_PASSWORD=пароль_от_почты
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=support@example.com
MAIL_FROM_NAME="My Laravel App"
```

<br>

### 3. Проверка работы

- После настройки, выполнить команду:

```bash
  php artisan tinker
```

- В открывшейся интерактивной консоли Laravel Tinker вставить код:
```
use Illuminate\Support\Facades\Mail;

Mail::raw('Проверка отправки письма', function($msg) {
    $msg->to('test@example.com')->subject('Тест Mail');
});
```

Если письмо дошло - конфигурация верна.

<br>

### 4. Безопасность

- Никогда не коммитить `.env` в репозиторий.
- Для GitHub и командной работы — использовать `.env.example` с пустыми значениями.
- Настоящие учётные данные хранить только в локальном `.env` и на сервере.

<br>

<h2 id="mailtrap">Настройка почтового клиента Laravel через Mailtrap</h2>

Mailtrap - это сервис для тестирования отправки писем. Он не доставляет письма реальным адресатам, а сохраняет их в виртуальный почтовый ящик, который можно просмотреть в веб-интерфейсе. Очень удобен для разработки.

<br>

### 1. Как получить данные подключения для Mailtrap

1. Перейти на сайт Mailtrap:
   [https://mailtrap.io/](https://mailtrap.io/)
2. Зарегистрироваться или войти в Mailtrap.
3. В панели управления выбрать или создать свой Inbox (почтовый ящик), на главной нажать `Email Sandbox` -> `Start Testing`.
4. Нажать Create Inbox.
5. Задать имя, при желании выбрать или создать Project -> Create.
6. Открыть созданный Inbox -> вкладка SMTP Settings или Integrations -> выбрать Laravel.
7. Нажать Integration или SMTP Settings.
8. В списке интеграций выбрать Laravel 9+ или просто SMTP.
9. Скопировать выданные SMTP-параметры именно этого Inbox и вставить их в `.env`.

<br>

### 2. Пример конфигурации для `.env`:

```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=login
MAIL_PASSWORD=password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="Laravel App"
```

<br>

### 3. Проверка:

- Этот маршрут Laravel, поместить в файл маршрутов `routes/web.php`, где вставить код:
```
use Illuminate\Support\Facades\Mail;

Mail::raw('Проверка отправки письма', function($msg) {
    $msg->to('test@example.com')->subject('Тест Mail');
});
```
- После настройки можно протестировать через команду в терминале `php artisan tinker`.
- Открыть в браузере: http://localhost:8000/mail-test

Если письмо дошло - конфигурация верна.

#### 4. Исправление ошибок

- Не указывать кавычки в `.env` для `MAIL_USERNAME` и `MAIL_PASSWORD`:
``` 
MAIL_USERNAME=538aa565437ebd
MAIL_PASSWORD=****a876
```

- Очистить кеш конфигурации:
``` 
php artisan config:clear
php artisan cache:clear
```

- Проверить доступность порта 2525 командой:
``` 
ping sandbox.smtp.mailtrap.io
```
- и командой:
``` 
telnet sandbox.smtp.mailtrap.io 2525
```

- Если telnet не подключается - проблема в сети или блокировке порта.
- Если порт 2525 недоступен, попробовать другой порт из настроек Mailtrap (587 или 465):
``` 
MAIL_PORT=587
MAIL_ENCRYPTION=tls 
```

или
``` 
MAIL_PORT=465
MAIL_ENCRYPTION=ssl
```

<br>

<h2 id="smtr">Настройка почтового клиента Laravel через SMTP любого внешнего сервера</h2>

SMTP - это стандартный протокол для отправки почты, который поддерживают все почтовые сервисы и хостинги. <br>
Можно использовать:
- Почтовый сервер вашего хостинга
- Корпоративную почту
- Почту от провайдера, например, Яндекс 360, Gmail, Outlook

<br>

### 1. Как получить данные подключения для SMTP

- Определить, какой сервис или сервер будет использоваться для отправки писем.
- Получить от администратора или в панели управления следующие данные:
  - SMTP-хост, например, `smtp.yandex.ru` или `smtp.gmail.com`
  - Порт - 587 для TLS или 465 для SSL
  - Логин, обычно - адрес почты
  - Пароль или сгенерированный пароль приложения, если используется Gmail или Яндекс с двухфакторной защитой
  - Тип шифрования `tls` или `ssl`

<br>

### 2. Пример `.env` для SMTP (например, Gmail):

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=your_email@example.com
MAIL_PASSWORD=password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@example.com
MAIL_FROM_NAME="Laravel App"
```
> Для Gmail обязательно включить двухфакторную аутентификацию и создать пароль приложения (как указано для Gmail выше).

<br>

### 3. Пример `.env` для SMTP (например, Яндекс):

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=пароль_приложения
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="Laravel App"
```

<br>

### 4. Рекомендации по безопасности

- Не хранить реальные данные (`MAIL_USERNAME`, `MAIL_PASSWORD`) в открытом виде в коде или в репозитории.
- Реальные данные храните только локально и на сервере.
- Файл `.env` уже по умолчанию в `.gitignore` - не удалять его оттуда и не коммитеть `.env` в репозиторий.
- Для командной разработки - использовать `.env.example` без реальных данных, без паролей.
- После правок `.env` не забывать выполнять команду `php artisan config:clear`

<br>

## Удаление записей о пользователях из базы

1. Стереть уже зарегистрированных пользователей через artisan tinker:
``` 
php artisan tinker
```
1.1. Выполнить команду, которая полностью очистить таблицу users:
``` 
\App\Models\User::truncate(); // полностью очистить таблицу users
```

1.2. Выборочно удалить пользователей командой:
``` 
$user = \App\Models\User::where('email', 'test@example.com')->first();
$user?->delete();
```

2. Стереть уже зарегистрированных пользователей через SQL напрямую, если используется SQLite:
``` 
DELETE FROM users;
```
или
``` 
DELETE FROM users WHERE email = 'test@example.com';
```

## Сброс базы целиком (для разработки)

Если проект ещё в разработке и данные не важны, для удаления всей базы, выполнить команду. Это удалит все таблицы:
``` 
php artisan migrate:fresh
```

Снова выполнить все миграции:
``` 
php artisan migrate
```
Если нужны ещё и тестовые данные:

``` 
php artisan migrate:fresh --seed
```

<br><br>

#### Роутинг:
- http://localhost:8000/test-telegram
- http://127.0.0.1:8000/users
- http://localhost:8000/front/users



<br><br><hr>
**В качестве решения приложить:** <br>
➔ ссылку на репозиторий с домашним заданием <br>
⚹ записать необходимые пояснения к выполненному заданию<br>
<hr>

**Критерии оценки работы:** <br>

**Принято:** <br>

— выполнены все пункты работы; <br>
— в работе используются указанные инструменты, соблюдены условия; <br>
— код корректно отформатирован по стандартам программирования на PHP; <br>
— код запускается, выводит данные на экран, не вызывает ошибок. <br>

**На доработку:** <br>
— выполнены не все пункты работы; <br>
— работа выполнена с ошибками. <br>

**Как отправить работу на проверку:** <br>

Отправьте коммит, содержащий код задания, на ветку master в вашем репозитории и пришлите его URL (URL Merge Request’а) через форму. Репозиторий должен быть public.


![PHP Laravel Framework](../archives/i-min.jpg)