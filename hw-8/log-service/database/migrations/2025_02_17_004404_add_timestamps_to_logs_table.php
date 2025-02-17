<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->timestamps(); // Это добавит столбцы created_at и updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->dropTimestamps(); // Это удалит столбцы created_at и updated_at при откате миграции
        });
    }

};
