# Продвинутое программирование на PHP — Laravel
## Урок 11. Реализация авторизации
### Домашнее задание
<br><br>
Цели практической работы<br>

Научиться:<br>

— интегрировать регистрацию и аутентификацию пользователей;<br>
— разрабатывать механизмы авторизации действий пользователей системы;<br>
— проектировать ролевую модель системы.<br>


Что нужно сделать:<br>

В этой практической работе вы реализуете проект, в котором будут использованы механизмы авторизации и аутентификации пользователей.<br>

1. Создайте новый проект Laravel или откройте уже существующий.

2. Создайте новую ветку вашего репозитория от корневой (main или master).

3. Установите библиотеку Laravel Breeze composer require laravel/breeze.

4. Установите файлы библиотеки php artisan breeze:install.

5. Соберите фронтенд проекта с помощью команд npm install && npm run dev.

6. Перейдите на ваш сайт и проверьте работу механизмов регистрации и аутентификации.

7. Создайте контроллер UsersController командой php artisan make:controller UsersController.

8. Создайте в классе UsersController функцию index, которая вернёт список всех пользователей системы.

9. Напишите маршрут ‘/users’ в файле web.php.

10. Создайте миграцию, которая добавит поле is_admin типа boolean в таблицу users.

11. Создайте политику php artisan make:policy UserPolicy --model=User и напишите функцию.

```
public function viewAny(User $user)
{
return $user->is_admin;
}
```

12. Зарегистрируйте политику в классе AuthServiceProvider.
```
protected $policies = [
User::class => UserPolicy::class,
];
```

13. Используйте авторизацию действий пользователя внутри контроллера UsersController в функции index.
    ```$this->authorize('view-any', User::class);```

14. Создайте двух пользователей, дайте одному из них роль администратора и попробуйте перейти на маршрут ‘/users’ вашего проекта сначала за неаутентифицированного пользователя, а далее за обычного пользователя и администратора системы.


##
## Домашнее задание
Открыть терминал и перейти в папку с уроком:
```
cd hw-11
```
## Инструкция
<br>

### 1. Создать новый проект Laravel

Открыть терминал и выполнить команду для создания проекта с именем `eleventh-laravel-app`:
```
laravel new eleventh-laravel-app
```

Перейти в директорию проекта:
```
cd eleventh-laravel-app
```
<br>

### 2. Создать новую ветку репозитория

Инициализировать git, если это ещё не выполнено подключение git:
```
git init
```

Создать новую ветку от основной ветки:
```
git checkout -b feature/auth-roles
```
<br>

### 3. Установить Laravel Breeze

Выполнить команду в терминале:
```
composer require laravel/breeze
```
<br>

### 4. Установить файлы Breeze

Выполнить команду:
```
php artisan breeze:install
```
<br>

### 5. Собрать фронтенд проекта

Установить зависимости и собрать проект:
```
npm install
npm run dev
```
<br>
Можно открыть страницу по адресу: <br>
Local:   http://localhost:5173/

<br><br>

### 6. Проверить работу регистрации и аутентификации

- Запустить локальный сервер:
```
php artisan serve
```
- Открыть браузер и перейти по адресу [http://localhost:8000](http://localhost:8000)
- Создать нового пользователя и проверить, что регистрация и вход в систему работают корректно.<br>
    Например:
    - Name: user
    - Email: user@user.email
    - Password: user-user    
- Откроется страница `http://localhost:8000/dashboard` и появится надпись: `You're logged in!`
<br><br>

### 7. Создать контроллер пользователей

Выполнить команду для генерации контроллера:
```
php artisan make:controller UsersController
```
<br>

### 8. Создать метод index в контроллере UsersController

Открыть файл `app/Http/Controllers/UsersController.php` и добавить метод:
```
use App\Models\User;

public function index()
{
    $this->authorize('view-any', User::class);
    return User::all();
}
```
<br>

### 9. Создать маршрут users

Открыть файл `routes/web.php` и добавить маршрут:
```
use App\Http\Controllers\UsersController;

Route::get('/users', [UsersController::class, 'index']);
```
<br>

### 10. Добавить поле is\_admin в таблицу users

- Создать миграцию:
```
php artisan make:migration add_is_admin_to_users_table --table=users
```

- Открыть созданный файл миграции и описать конструкцию в методе `up()`:
```
$table->boolean('is_admin')->default(false);
```

- Запустить миграции:
```
php artisan migrate
```
<br>

### 11. Создать политику UserPolicy

- Выполнить команду:
```
php artisan make:policy UserPolicy --model=User
```
- Открыть файл `app/Policies/UserPolicy.php` и добавить метод:
```
public function viewAny(User $user)
{
    return $user->is_admin;
}
```
<br>

### 12. Зарегистрировать политику

Открыть файл `app/Providers/AuthServiceProvider.php` и добавить в массив `policies`:
```
use App\Models\User;
use App\Policies\UserPolicy;

protected $policies = [
    User::class => UserPolicy::class,
];
```
<br>

### 13. Использовать авторизацию в контроллере

- Проверить, что в методе `index` контроллера `app/Http/Controllers/UsersController.php
` присутствует вызов:
```
$this->authorize('view-any', User::class);
```
- Добавить трейт AuthorizesRequests в начало контроллера:
```
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
```

- Добавить `AuthorizesRequests` в список use внутри класса UsersController:
   ```
   class UsersController extends Controller
   {
   use AuthorizesRequests;

   public function index()
   {
   $this->authorize('view-any', User::class);
   return User::all();
   }
   }
  ```
<br>

### 14. Проверить работу политики авторизации

- Перейти по маршруту [http://localhost:8000/register](http://localhost:8000/register)
- Создать в браузере двух пользователей, один из которых уже создан, другой, например:
  - Name: admin
  - Email: admin@admin.email
  - Password: admin-admin
- Открыть базу данных и вручную установить для одного из пользователей значение `is\_admin` в `true`
<br><br>

### 15. Выполнить изменения в базе данных

#### Вариант 1. Через графический интерфейс базы данных

Использовать, например, TablePlus, DBeaver, HeidiSQL, phpMyAdmin.
1. Открыть подключение к базе данных Laravel-проекта.
2. Найти таблицу `users`.
3. Найти строку пользователя с email `admin@admin.email`.
4. В колонке `is_admin` установить значение `true` (или `1`).
5. Сохранить изменения.

#### Вариант 2. Через встроенный терминал SQLite, если используется SQLite

Если в `.env` используется SQLite:

1. Перейти в корень проекта.
2. Открыть SQLite CLI:
```bash
sqlite3 database/database.sqlite
```
3. Выполнить SQL-команду:

```
UPDATE users SET is_admin = 1 WHERE email = 'admin@admin.email';
```

#### Вариант 3. Через artisan tinker

Если выполнять изменения в базе данных это через фреймворк Laravel:
1. Открыть терминал в корне проекта.
2. Выполнить команду:
```
php artisan tinker
```
3. Ввести код:
```
$user = \App\Models\User::where('email', 'admin@admin.email')->first();
$user->is_admin = true;
$user->save();
```
4. Выйти из Tinker:
```
exit
```

**После этого**:
- Перейти по маршруту [http://localhost:8000/users](http://localhost:8000/users)
- Проверить, есть ли доступ к списку пользователей:
  
```
[
  {
    "id": 1,
    "name": "user",
    "email": "user@user.email",
    "email_verified_at": null,
    "created_at": "2025-08-06T00:15:26.000000Z",
    "updated_at": "2025-08-06T00:15:26.000000Z",
    "is_admin": 0
  },
  {
    "id": 2,
    "name": "admin",
    "email": "admin@admin.email",
    "email_verified_at": null,
    "created_at": "2025-08-06T00:31:34.000000Z",
    "updated_at": "2025-08-06T00:44:53.000000Z",
    "is_admin": 1
  }
]
```
  - от администратора должен быть выведен список пользователей
  - от обычного пользователя, если войти под обычным пользователем, должен быть отказ в доступе, доступ к users будет запрещён (403) `403 | This action is unauthorized.`
  - без авторизации, если не войти вообще - должен быть редирект на страницу входа, перенаправление на страницу http://localhost:8000/login <br>
  
**Для этого**:
- перейти по маршруту http://localhost:8000/login
- войти как пользователь admin@admin.email
- перейти на http://localhost:8000/users
- увидеть список пользователей, если политика авторизации настроена правильно:
```
[
  {
    "id": 1,
    "name": "user",
    "email": "user@user.email",
    "email_verified_at": null,
    "created_at": "2025-08-06T00:15:26.000000Z",
    "updated_at": "2025-08-06T00:15:26.000000Z",
    "is_admin": 0
  },
  {
    "id": 2,
    "name": "admin",
    "email": "admin@admin.email",
    "email_verified_at": null,
    "created_at": "2025-08-06T00:31:34.000000Z",
    "updated_at": "2025-08-06T00:44:53.000000Z",
    "is_admin": 1
  }
]
```

<br>

### 15. Создать коммит

При необходимости по окончанию работы, оформить финальный коммит и отправить изменения в удалённый репозиторий.


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
<br><br><br>

![PHP Laravel Framework](../archives/i-min.jpg)

<br><br><br>