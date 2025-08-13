<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsPageController extends Controller
{
    public function __invoke(Request $request)
    {
        // Поиск/сортировка, опционально из query-параметров
        $q    = trim((string) $request->query('q', ''));
        $sort = $request->query('sort', 'id');        // id|name|price|created_at
        $dir  = $request->query('dir', 'desc');       // asc|desc

        if (!in_array($sort, ['id','name','price','created_at'], true)) $sort = 'id';
        if (!in_array($dir,  ['asc','desc'], true))  $dir  = 'desc';

        $query = Product::query()->select(['id','sku','name','price','created_at']);
        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('name', 'like', "%{$q}%")
                    ->orWhere('sku', 'like', "%{$q}%");
            });
        }

        $products = $query->orderBy($sort, $dir)
            ->paginate(10)
            ->withQueryString();

        return view('products.index', compact('products','q','sort','dir'));
    }
}
