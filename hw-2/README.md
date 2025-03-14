# Продвинутое программирование на PHP — Laravel
## Урок 2. Контроллеры, экшены и роутинг
### Домашнее задание
<br><br>
Цели:<br>

Вы научитесь:<br>

— устанавливать Laravel;<br>
— создавать контроллер, возвращающий JSON;<br>
— создавать контроллер для обработки формы;<br>
— создавать контроллер, возвращающий шаблон.<br>

Что нужно сделать:<br>

Вам предстоит установить фреймворк Laravel и создать контроллер, содержащий экшены для вывода и обработки формы.<br>

1. Установите Laravel с помощью composer, выполнив команду composer create-project laravel/laravel <имя проекта>. <br>
   В поле <имя проекта> впишите имя вашего проекта. Этому имени будет соответствовать имя папки, в которую вы поместите проект.<br>

2. Создайте контроллер для вывода формы на страницу и её обработки. <br>
   В командную строку введите команду php artisan make:controller FormProcessor.<br>

3. После выполнения команды убедитесь, что контроллер создан, — соответствующий файл должен появиться в папке app/Http/Controllers.

4. Внутри контроллера опишите метод index: он должен выводить в браузер форму для заполнения.<br>
   — Опишите форму в виде шаблона blade.<br>
   — Внутри формы должны быть поля для ввода имени, фамилии и email пользователя.<br>
   — Форма отправляется методом POST.<br>
   — Параметр action пока оставьте пустым.<br>
   — Не забудьте про CSRF.<br>

5. Внутри файла /routes/web.php опишите новый роут (метод GET), который будет вызывать метод index контроллера FormProcessor по url /userform.

6. Запустите встроенный сервер Laravel командой php artisan serve --port=8080 и убедитесь, что форма выводится по адресу http://localhost:8080/userform.

7. В контроллере FormProcessor создайте метод store для обработки формы. Этот метод должен принимать поля формы и отправлять ответ в виде JSON-объекта, содержащего значения полей формы (имя, фамилия, email).

8. Внутри файла /routes/web.php опишите новый роут (метод POST), который будет вызывать метод store контроллера FormProcessor по url /store_form.

9. Отредактируйте поле action формы в шаблоне и укажите адрес /store_form.

10. Откройте форму в браузере по адресу http://localhost:8080/userform, заполните её и попробуйте отправить на сервер, нажав кнопку Submit. Если всё сделано правильно, вы увидите в браузере объект JSON.

11. Создайте новый шаблон blade для приветствия пользователя (например: «Привет, <имя>!»).

12. Измените метод store контроллера FormProcessor таким образом, чтобы вместо JSON он возвращал шаблон, заполненный данными пользователя.

13. Сделайте коммит своих изменений с помощью git и отправьте push в репозиторий.

### Решение задание

1. Создаем шаблоны для страниц в папке views/user для Формы form.blade.php и Поля Ответного приветствия greeting.blade.php
2. Создаем контроллер UserController.php с методом index, который будет возвращать представление с формой
3. Создаем контроллер FormProcessor.php с обработкой методов GET и POST
4. Добавляем маршрут файле routes/web.php и прописываем путь к контроллерам и указываем адрес обращения к страницы формы
5. Запускаем страницу в браузере по адресу http://localhost:8000/userform <br><br>
![](../archives/hw-2-1.jpg) <br><br>
6. Заполняем необходимые данные <br><br>
![](../archives/hw-2-2.jpg) <br><br>
7. После отправки формы, получаем ответ со страницы приветствия <br><br>
![](../archives/hw-2-3.jpg) <br>



<br><br><br>

**Советы и рекомендации**<br>
Старайтесь писать в commit message то, что отражает смысл вашего кода.<br>

<br><br><hr>
**В качестве решения приложить:** <br>
➔ ссылку на репозиторий с домашним заданием <br>
⚹ записать необходимые пояснения к выполненному заданию<hr><br>
**Критерии оценки работы:**<br>

**Принято:**<br>
— выполнены все пункты задания;<br>
— в работе используются указанные инструменты и соблюдены условия;<br>
— код корректно отформатирован по стандартам программирования на PHP;<br>
— скрипт запускается, выводит различные данные на экран, не вызывает ошибок.<br>

**На доработку:**<br>
— выполнены не все обязательные пункты задания;<br>
— задание выполнено с ошибками.<br>

**Как отправить работу на проверку**<br>
Отправьте коммит, содержащий код задания, на ветку master в вашем репозитории и пришлите его URL (URL Merge Request’а) через форму. Репозиторий должен быть public.
<br><br><br>

![PHP Laravel Framework](../archives/i-min.jpg)

<br><br><br>