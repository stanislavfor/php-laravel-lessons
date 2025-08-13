<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use HasFactory;
    protected $fillable = ['sku', 'name', 'price'];

    // Если нужно, чтобы price всегда был с 3 знаками:
    protected $casts = ['price' => 'decimal:3'];

}
