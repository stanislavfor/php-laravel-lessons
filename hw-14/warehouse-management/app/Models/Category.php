<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Отношение "категория имеет много продуктов"
    public function product() {
        return $this->hasMany(Product::class);
    }
}
