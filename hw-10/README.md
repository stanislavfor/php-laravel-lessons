# Продвинутое программирование на PHP — Laravel
## Урок 10. Встроенные возможности Laravel
### Домашнее задание
<br><br>
Цели практической работы:<br>

Научиться:<br>

— создавать асинхронные задачи и вызывать их;<br>
— настраивать очередь через базу данных и добавлять в неё задачи;<br>
— выполнять задачи через планировщик задач Laravel.<br>

В рамках практической работы вы реализуете очистку файла логирования приложения с помощью асинхронной задачи, помещенной в планировщик задач.<br>

Что нужно сделать:<br>

1. Создайте новый проект Laravel или откройте уже существующий.

2. Создайте новую ветку вашего репозитория от корневой (main или master).

3. Создайте миграцию для очереди через базу данных командой php artisan queue:table.

4. Выполните миграцию.

5. Пропишите в файле .env QUEUE_CONNECTION=database.

6. Создайте класс ClearCache.php с помощью команды php artisan make:job ClearCache.

7. В файле ClearCache.php пропишите код для очистки лог-файла.<br>
![](../archives/pic-10-1.jpg)<br>
```
/**
* Execute the job.
*
* @raturn void
*/
public function handle()
{
   file_put_contents(storage_path( path: "logs/laravel.log ), '');
}

```
8. Поместите вызов Job в планировщик задач Laravel в файле app/Console/Kernel.php.<br>
   ![](../archives/pic-10-2.jpg)<br>
```
protected Function schedule(Schedule $schedule)
{
   $schedule->job(ClearCache::class)->hourly();
}
```
9. Запустите очередь командой php artisan queue:listen.

10. Запустите планировщик задач командой php artisan schedule:work и не закрывайте терминал.

##
## Домашнее задание
Открыть терминал и перейти в папку с уроком:
```
cd hw-10
```
<br>

## Инструкция
<br>

### 1. Создать новый проект Laravel с именем tenth-laravel-app

Открыть терминал. Выполнить команду:

```
laravel new tenth-laravel-app
```

Перейти в директорию проекта:

```
cd tenth-laravel-app
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

<br>

### 2. Создать новую ветку репозитория от основной ветки

Инициализировать git, если это ещё не выполнено подключение git:

```
git init
```

Создать ветку и переключиться на нее:

```
git checkout -b feature/clear-cache-job
```

<br>

### 3. Создать миграцию таблицы для очередей

Выполнить команду в терминале:

```
php artisan queue:table
```

<br>

### 4. Выполнить миграцию базы данных

Запустить команду миграции:

```
php artisan migrate
```
<br>

### 5. Указать использование очередей через базу данных

Открыть файл с настройками окружения `.env`
Найти строку `QUEUE\_CONNECTION` и установить значение `database`:

```
QUEUE_CONNECTION=database
```

Сохранить изменения.

<br>

### 6. Создать задание ClearCache

Выполнить команду для создания класса задания:

```
php artisan make:job ClearCache
```
<br>

### 7. Описать логику задачи очистки логов

Открыть файл `ClearCache.php` в каталоге `app/Jobs`
Найти метод `handle` и прописать содержимое функции:

```
public function handle()
{
    file_put_contents(storage_path('logs/laravel.log'), '');
}
```

Сохранить файл:
```
storage/logs/laravel.log
```

<br>

### 8. Поместить задачу в планировщик Laravel

Открыть файл `app/Console/Kernel.php` и добавить в начало файла строку подключения:

```
use App\Jobs\ClearCache;
```

В методе `schedule` описать задачу

```
protected function schedule(Schedule $schedule)
{
    $schedule->job(ClearCache::class)->hourly();
}
```
Сохранить файл.

<br>

### 9. Запустить очередь задач

Открыть новый терминал в корне проекта и выполнить команду:
```
php artisan queue:listen
```
Не закрывать терминал.

<br>

### 10. Запустить планировщик задач Laravel

В новом терминале выполнить команду:
```
php artisan schedule:work
```
Не закрывать терминал. Пример сообщений в терминале:

```
   INFO  Processing jobs from the [default] queue.


   INFO  Processing jobs from the [default] queue.


   INFO  Processing jobs from the [default] queue.


   INFO  Processing jobs from the [default] queue.
```

По завершении этих действий приложение будет автоматически очищать лог-файл `storage/logs/laravel.log` каждый час с помощью асинхронного задания, выполняемого через очередь и планировщик.
Пример записи в файле:
```
[2025-08-05 22:55:30] local.INFO: Laravel log test 
[2025-08-05 23:42:59] local.INFO: Laravel log test  
[2025-08-05 23:43:02] local.INFO: Laravel log test  
```

Адрес в браузере: http://127.0.0.1:8000/logs


<br><br><hr>
**В качестве решения приложить:** <br>
➔ ссылку на репозиторий с домашним заданием <br>
⚹ записать необходимые пояснения к выполненному заданию<hr><br>
**Что оценивается:**<br>

**Принято:**<br>

— выполнены все пункты работы;<br>
— в работе используются указанные инструменты, соблюдены условия;<br>
— код корректно отформатирован по стандартам программирования на PHP;<br>
— код запускается, выводит различные данные на экран, не вызывает ошибок.<br>

**На доработку:**<br>
— выполнены не все пункты работы;<br>
— работа выполнена с ошибками.<br>

**Как отправить работу на проверку:**<br>

Отправьте коммит, содержащий код задания, на ветку master в вашем репозитории и пришлите его URL (URL Merge Request’а) через форму. Репозиторий должен быть public.
<br><br><br>

![PHP Laravel Framework](../archives/i-min.jpg)

<br><br><br>
