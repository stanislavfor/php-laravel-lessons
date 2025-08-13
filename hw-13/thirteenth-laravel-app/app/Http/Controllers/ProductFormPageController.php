<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductFormPageController extends Controller
{
    // Страница создания (STORE)
    public function create()
    {
        return view('products.create');
    }

    // Страница просмотра (с кнопками Редактировать/Удалить)
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Страница редактирования (UPDATE)
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }
}
