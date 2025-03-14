# Продвинутое программирование на PHP — Laravel
## Урок 12. Интеграция с внешними сервисами
### Домашнее задание
<br><br>
Цели практической работы:<br>

Научиться:<br>

— интегрировать отправку писем через почтовый клиент;<br>
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



<br><br>

### Домашнее задание

<br><br><hr>

### Инструкция



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