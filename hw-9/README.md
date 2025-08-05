# Продвинутое программирование на PHP — Laravel
## Урок 9. Работа с событиями
### Домашнее задание
<br><br>
Цели практической работы:<br>

Научиться:<br>

— создавать события и вызывать их;<br>
— создавать слушатели и привязывать их к событию;<br>
— применять наблюдатели моделей.<br>

Что нужно сделать:<br>

1. Создайте новый проект Laravel или откройте уже существующий.<br>

2. Создайте новую ветку вашего репозитория от корневой (main или master).<br>

3. Создайте миграцию командой php artisan make:migration CreateNewsTable со следующими полями:<br>
![](../archives/pic-9-1.jpg)<br>
```
Schema::create( table: 'news', function (Blueprint $table) {
    $table->id();
    Stable->string( column: 'title');
    Stable->string( column: 'slug')->nullable();
    $table->text( column: "body);
    Stable->boolean( column: 'hidden')->default( value: 0);
    $table->timestamps();
});

```
4. Создайте модель News.<br>

5. Создайте событие NewsHidden и присвойте полю класса $news параметр $news в конструкторе класса.<br>
   ![](../archives/pic-9-2.jpg)<br>
```
public function ＿construct(News $news)
    {
        $this->news = $news;
    }
```
6. Создайте слушатель NewsHiddenListener, в котором опишите логику слушателя, используя функцию:<br>
   Log::info(‘News ’ . $event->news->id . ‘ hidden’);.

7. Зарегистрируйте событие и слушатель в классе EventServiceProvider.

8. В файле routes/web.php создайте необходимый маршрут ‘/news/create-test’, использующий метод get для создания тестовой новости, и пропишите логику создания тестовой новости.<br>
   ![](../archives/pic-9-3.jpg)<br>
```
Route::get( uri: 'news/create-test", function () {
    $news = new News();
    $news->title = 'Test news title';
    $news->body = 'Test news body';
    $news->save();
    return $news;
});
```
9. В файле routes/web.php создайте необходимый маршрут, использующий метод get ‘/news/{id}/hide’ для скрытия новости. Измените атрибут is_hidden на значение true. После этой операции вызовите событие NewsHidden с помощью инструкции NewsHidden::dispatch($news);.<br>
   ![](../archives/pic-9-4.jpg)<br>
```
Route::get( uri: 'news/{id}/hide', function (Sid) {
    $news = News::find0rFail(Sid);
    $news->hidden = true;
    $news->save();
    // Вызовите событие NewsHidden.
    return 'News hidden';
};
```
10. В файле storage/logs/laravel.log проверьте, сработал ли слушатель, в нём должна появиться строка ‘News hidden 1’, где 1 — это id скрытой новости (может отличаться).<br>

11. Создайте класс-наблюдатель NewsObserver.

12. Зарегистрируйте его в файле App\Providers\EventServiceProvider в функции boot.

13. Опишите логику изменения поля slug новости при вызове события saving в наблюдателе NewsObserver с помощью инструкции.
    ![](../archives/pic-9-5.jpg)<br>
    ```
    $news->slug = Str::slug($news->title);
    ```
    Эта инструкция использует класс Str, который можно подключить с помощью инструкции в начале файла.
    ![](../archives/pic-9-6.jpg)<br>
    ```
    use Illuminate\Support\Str;
    ```
14. Создайте ещё одну новость с помощью маршрута ‘/news/create-test’.

15. Проверьте заполнение поля slug через базу данных. Оно должно выглядеть следующим образом: «test-news-title» (если вы оставили такое же название, как в примере).

16. Сделайте коммит изменений с помощью Git и отправьте push в репозиторий.


##
## Домашнее задание

#### Вариант выполнения 1. Установить Laravel Installer глобально через Composer

Открыть терминал и выполнить команду:

```
composer global require laravel/installer
```
После установки убедиться, что глобальные пакеты Composer находятся в системной переменной `PATH`. 

Для Windows добавить в переменную окружения следующий путь:
```
%USERPROFILE%\AppData\Roaming\Composer\vendor\bin
```
Открыть терминал и перейти в папку с уроком:
```
cd hw-9
```
Выполнить команду для создания нового проекта Laravel с именем `ninth-laravel-app`.

    ```bash
        laravel new ninth-laravel-app
    ```

#### Вариант выполнения 2. Использовать `composer create-project` без Laravel Installer

Если не требуется именно Laravel Installer, можно сразу создать проект.

Открыть терминал и перейти в папку с уроком:
```
cd hw-9
```
Этот способ работает независимо от глобальной установки Laravel Installer:

```
composer create-project laravel/laravel ninth-laravel-app
```

## Инструкция

<br>

### 1. Создание проекта Laravel

Открыть терминал и перейти в папку с уроком:
```
cd hw-9
```
Чтобы создать новый проект Laravel, можно использовать команду composer create-project.
Composer самостоятельно загрузит все необходимые файлы и зависимости.
Пример:
    ```
        composer create-project --prefer-dist laravel/laravel ninth-laravel-app
    ``` 
или
    ```
        composer create-project laravel/laravel ninth-laravel-app    
    ```
, где  `ninth-laravel-app` - имя проекта.


Можно создать проект, выполнив команду для создания нового проекта Laravel с именем `ninth-laravel-app`.

    ```bash
        laravel new ninth-laravel-app
    ```
<br>

Перейти в папку с проектом laravel:
```
cd ninth-laravel-app
```

Запустить проект командой:
```
php artisan serve
```

После запуска в терминале появится сообщение:

```
INFO Starting Laravel development server: http://127.0.0.1:8000
```

Открыть браузер и перейти по адресу: http://127.0.0.1:8000


### 2. Создание новой ветки

Инициализировать репозиторий, если это ещё не выполнено подключение git:

```
git init
```

Создать и перейти на новую ветку:

```
git checkout -b feature/news-events
```

<br>

### 3. Создание миграции таблицы новостей

Создать миграцию:

```
php artisan make:migration CreateNewsTable
```

Открыть созданный файл миграции в папке database/migrations и заменить содержимое метода `up()` на следующую запись:

```
Schema::create('news', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->nullable();
    $table->text('body');
    $table->boolean('hidden')->default(false);
    $table->timestamps();
});
```

Запустить миграцию:

```
php artisan migrate
```

<br>

### 4. Создание модели `News`

Выполнить команду:

```
php artisan make:model News
```

<br>

### 5. Создание события `NewsHidden`

Создать событие:

```
php artisan make:event NewsHidden
```

Открыть файл события `app/Events/NewsHidden.php` и добавить:

```
use App\Models\News;

public News $news;

public function __construct(News $news)
{
    $this->news = $news;
}
```

<br>

### 6. Создание слушателя `NewsHiddenListener`

Создать слушатель:

```
php artisan make:listener NewsHiddenListener
```

Внутри метода `handle` прописать:

```
use Illuminate\Support\Facades\Log;

public function handle(NewsHidden $event)
{
    Log::info('News ' . $event->news->id . ' hidden');
}
```

<br>

### 7. Регистрация события и слушателя

Открыть файл `app/Providers/EventServiceProvider.php` и добавить в массив `protected $listen`:

```
use App\Events\NewsHidden;
use App\Listeners\NewsHiddenListener;

protected $listen = [
    NewsHidden::class => [
        NewsHiddenListener::class,
    ],
];
```

<br>

### 8. Маршрут `/news/create-test`

В файле `routes/web.php` добавить маршрут:

```
use App\Models\News;

Route::get('news/create-test', function () {
    $news = new News();
    $news->title = 'Test news title';
    $news->body = 'Test news body';
    $news->save();
    return $news;
});
```

<br>

### 9. Маршрут `/news/{id}/hide`

В файле `routes/web.php` добавить второй маршрут:

```
use App\Events\NewsHidden;

Route::get('news/{id}/hide', function ($id) {
    $news = News::findOrFail($id);
    $news->hidden = true;
    $news->save();
    NewsHidden::dispatch($news);
    return 'News hidden';
});
```

<br>

### 10. Проверка логов

Открыть файл `storage/logs/laravel.log` и найти сообщение вида:
```
News 1 hidden
```
, где 1 - это id скрытой новости.

<br>

### 11. Создание наблюдателя `NewsObserver`

Выполнить команду:

```
php artisan make:observer NewsObserver --model=News
```

В файле `app/Observers/NewsObserver.php` в методе `saving` прописать:

```
use Illuminate\Support\Str;

public function saving(News $news)
{
    $news->slug = Str::slug($news->title);
}
```

<br>

### 12. Регистрация наблюдателя

В `App\Providers\AppServiceProvider.php` в методе `boot` прописать:

```
use App\Models\News;
use App\Observers\NewsObserver;

public function boot()
{
    News::observe(NewsObserver::class);
}
```

<br>

### 13. Проверка генерации `slug`

Снова перейти по адресу:

```
http://localhost:8000/news/create-test
```

Зайти в базу данных и проверить поле `slug`. 
Оно должно содержать строку `test-news-title`.

Например:
```
{
  "title": "Test news title",
  "body": "Test news body",
  "slug": "test-news-title",
  "updated_at": "2025-08-05T02:37:54.000000Z",
  "created_at": "2025-08-05T02:37:54.000000Z",
  "id": 2
}
```

<br>

### 14. Коммит и пуш

Добавить файлы в индекс:

```
git add .
```

Создать коммит:

```
git commit -m "Added events, listeners, and observers for the model News"
```

Отправить изменения:

```
git push origin feature/news-events
```







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

<br><br><br>