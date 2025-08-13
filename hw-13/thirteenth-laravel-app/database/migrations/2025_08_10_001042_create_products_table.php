<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//return new class extends Migration

/** @noinspection PhpUnused */
class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
//    public function up(): void
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('sku');
            $table->string('name');
            $table->decimal('price', 9, 3);
        });
    }

    /**
     * Reverse the migrations.
     */
//    public function down(): void
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
