# Продвинутое программирование на PHP — Laravel
## Урок 13. Тестирование и отладка Laravel-приложений
### Домашнее задание
<br><br>
Цели практической работы<br>

Научиться:<br>

— создавать класс-фабрику и класс-наполнитель и использовать их;<br>
— создавать контроллер и тестировать его с помощью Postman;<br>
— писать feature-тесты для проверки работы методов контроллера.<br>

Что нужно сделать:<br>

В этой практической работе вы реализуете уведомления через внешние сервисы.<br>

1. Создайте новый проект Laravel или откройте уже существующий.

2. Создайте новую ветку вашего репозитория от корневой (main или master).

3. Создайте сущность Product (модель, миграцию и контроллер) командой php artisan make:model Product -mc.

4. Опишите миграцию для таблицы products c типами полей:

```
$table->string('sku');
$table->string('name');
$table->decimal('price', 9, 3);
```

5. Выполните миграцию командой php artisan migrate.

6. Добавьте в файл api.php маршруты:
```
Route::apiResource('products', \App\Http\Controllers\ProductController::class);
```   

7. Создайте класс-фабрику для сущности Product c помощью команды php artisan make:factory ProductFactory.

8. Создайте класс-наполнитель для сущности Product c помощью команды php artisan make:seeder ProductsSeeder.

9. Выполните команду php artisan migrate –-seed для наполнения базы данных сгенерированными данными.

10. В классе ProductController реализуйте методы index, show, store, update, destroy.

11. Протестируйте каждый из маршрутов контроллера ProductController с помощью Postman и приложите скриншоты ответа на запросы в папку postman-screenshots (названия файлов должны соответствовать формату index.jpeg, show.jpeg, store.jpeg, update.jpeg, destroy.jpeg для каждого метода, соответственно).

12. Создайте тест c помощью команды php artisan make:test Products/ProductTest.

13. Опишите функции:

```
test_products_can_be_indexed,
test_product_can_be_shown,
test_product_can_be_stored,
test_product_can_be_updated,
test_product_can_be_destroyed.

```

14. Запустите выполнение тестов командой php artisan test.


##
## Домашнее задание
Открыть терминал и перейти в папку с уроком:
```
cd hw-13
```
## Инструкция
### 1. Создать новый проект Laravel

- Открыть терминал и выполнить команду:
```
laravel new thirteenth-laravel-app
```

- Перейти в созданную директорию проекта:
```
cd thirteenth-laravel-app
```

### 2. Создать новую ветку репозитория

- Инициализировать git-репозиторий:
```
git init
```

- Создать и переключиться на новую ветку:
```
git checkout -b feature/products-crud
```

### 3. Создать сущность Product

Выполнить команду для создания модели, миграции и контроллера:
```
php artisan make:model Product -mc
```

### 4. Описать миграцию таблицы products

- Открыть файл миграции из каталога `database/migrations`, в методе `up` добавить:

```
$table->string('sku');
$table->string('name');
$table->decimal('price', 9, 3);
```
- Сохранить файл.

### 5. Выполнить миграцию базы данных

Запустить команду:
```
php artisan migrate
```

### 6. Добавить маршруты API

Открыть файл `routes/api.php` и добавить маршрут:
```
use App\Http\Controllers\ProductController;

Route::apiResource('products', ProductController::class);
```

### 7. Создать класс-фабрику для Product

- Выполнить команду:
```
php artisan make:factory ProductFactory
```

- Открыть файл `database/factories/ProductFactory.php` и добавить генерацию данных:
```
public function definition()
{
    return [
        'sku' => $this->faker->unique()->bothify('SKU-####'),
        'name' => $this->faker->words(3, true),
        'price' => $this->faker->randomFloat(3, 10, 999),
    ];
}
```

### 8. Создать класс-наполнитель ProductsSeeder

- Выполнить команду:

```
php artisan make:seeder ProductsSeeder
```

- Открыть файл `database/seeders/ProductsSeeder.php` и добавить наполнение:

```
use App\Models\Product;

public function run()
{
    Product::factory()->count(10)->create();
}
```

- Открыть файл `DatabaseSeeder.php` и вызвать `ProductsSeeder`:
```
$this->call(ProductsSeeder::class);
```

### 9. Выполнить миграцию с наполнением базы

Запустить команду:
```
php artisan migrate --seed
```

### 10. Реализовать методы в контроллере ProductController

Открыть файл `app/Http/Controllers/ProductController.php` и добавить методы:
```
use App\Models\Product;
use Illuminate\Http\Request;

public function index()
{
    return Product::all();
}

public function show($id)
{
    return Product::findOrFail($id);
}

public function store(Request $request)
{
    $product = Product::create($request->all());
    return response()->json($product, 201);
}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $product->update($request->all());
    return response()->json($product, 200);
}

public function destroy($id)
{
    Product::destroy($id);
    return response()->json(null, 204);
}
```

Добавить защиту в модели `Product`, указав разрешённые поля:
```
protected $fillable = ['sku', 'name', 'price'];
```

### 11. Протестировать маршруты в Postman

Запустить сервер Laravel:
```
php artisan serve
```

Открыть Postman и выполнить запросы:
```
* GET /api/products
* GET /api/products/{id}
* POST /api/products
* PUT /api/products/{id}
* DELETE /api/products/{id}
```

Сохранить скриншоты ответов в папку postman-screenshots, например, с именами запросов:
* index.jpeg
* show\.jpeg
* store.jpeg
* update.jpeg
* destroy.jpeg

### 12. Создать тест ProductTest

Выполнить команду:
```
php artisan make:test Products/ProductTest
```

### 13. Написать функции тестирования

Открыть файл `tests/Feature/Products/ProductTest.php` и добавить методы:
```
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

public function test_products_can_be_indexed()
{
    Product::factory()->count(3)->create();

    $response = $this->getJson('/api/products');

    $response->assertStatus(200);
}

public function test_product_can_be_shown()
{
    $product = Product::factory()->create();

    $response = $this->getJson('/api/products/' . $product->id);

    $response->assertStatus(200);
}

public function test_product_can_be_stored()
{
    $data = [
        'sku' => 'TEST1234',
        'name' => 'Test Product',
        'price' => 123.456,
    ];

    $response = $this->postJson('/api/products', $data);

    $response->assertStatus(201);
}

public function test_product_can_be_updated()
{
    $product = Product::factory()->create();

    $response = $this->putJson('/api/products/' . $product->id, [
        'name' => 'Updated Name',
    ]);

    $response->assertStatus(200);
}

public function test_product_can_be_destroyed()
{
    $product = Product::factory()->create();

    $response = $this->deleteJson('/api/products/' . $product->id);

    $response->assertStatus(204);
}
```

### 14. Запустить тестирование

- Выполнить команду:
```
php artisan test
```
- Проверить, что все тесты выполнены успешно.
- При необходимости исправить ошибки и повторно запустить тестирование.



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