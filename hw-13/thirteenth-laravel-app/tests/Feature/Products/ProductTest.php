<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithFaker; // migrate:fresh для тестовой БД + faker при необходимости

    public function test_homepage_is_ok(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_products_can_be_indexed(): void
    {
        Product::factory()->count(3)->create();

        $response = $this->getJson(route('products.index'));

        // Т.к. в контроллере index() используется paginate(),
        // ожидаем { data: [...], links: {...}, meta: {...} }
        $response->assertOk()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'sku', 'name', 'price', 'created_at', 'updated_at'],
                ],
                'links',
                'meta',
            ]);
    }

    public function test_product_can_be_shown(): void
    {
        $product = Product::factory()->create();

        $response = $this->getJson(route('products.show', $product));

        $response->assertOk()
            ->assertJsonFragment([
                'id'   => $product->id,
                'sku'  => $product->sku,
                'name' => $product->name,
            ]);
    }

    public function test_product_can_be_stored(): void
    {
        $data = [
            'sku'   => $this->faker->unique()->bothify('SKU-####'),
            'name'  => $this->faker->words(3, true),
            'price' => $this->faker->randomFloat(3, 10, 999),
        ];

        // вызов по имени роута
        $response = $this->postJson(route('products.store'), $data);

        $response->assertCreated()
            ->assertJsonFragment([
                'sku'  => $data['sku'],
                'name' => $data['name'],
            ]);

        $this->assertDatabaseHas('products', ['sku' => $data['sku']]);
    }

    public function test_product_can_be_updated(): void
    {
        $product = Product::factory()->create();

        $payload = ['name' => 'Updated Name'];

        $response = $this->putJson(route('products.update', $product), $payload);

        $response->assertOk()
            ->assertJsonFragment($payload);

        $this->assertDatabaseHas('products', [
            'id'   => $product->id,
            'name' => 'Updated Name',
        ]);
    }

    public function test_product_can_be_destroyed(): void
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson(route('products.destroy', $product));

        $response->assertNoContent();

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
