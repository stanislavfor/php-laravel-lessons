<?php

namespace App\Http\Controllers;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * GET /api/products
     */
//    public function index(Request $request)
//    {
//        $perPage = (int) $request->query('per_page', 15);
//
//        $products = Product::query()
//            ->orderByDesc('id')
//            ->paginate($perPage);
//
//        return response()->json($products, Response::HTTP_OK);
//    }

    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 15);

        $products = Product::query()
            ->orderByDesc('id')
            ->paginate($perPage);

        // ресурсная коллекция над пагинатором появятся keys data/links/meta
        return ProductResource::collection($products);
    }

    /**
     * GET /api/products/{product}
     * (implicit route model binding)
     */
    public function show(Product $product)
    {
        return response()->json($product, Response::HTTP_OK);
    }

    /**
     * POST /api/products
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sku'   => ['required', 'string', 'max:64', 'unique:products,sku'],
            'name'  => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'between:0,999999.999'],
        ]);

        $product = Product::create($validated);

        return response()
            ->json($product, Response::HTTP_CREATED)
            ->header('Location', route('products.show', $product));
    }

    /**
     * PUT /api/products/{product}
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'sku'   => [
                'sometimes', 'required', 'string', 'max:64',
                Rule::unique('products', 'sku')->ignore($product->id),
            ],
            'name'  => ['sometimes', 'required', 'string', 'max:255'],
            'price' => ['sometimes', 'required', 'numeric', 'between:0,999999.999'],
        ]);

        $product->fill($validated)->save();

        return response()->json($product, Response::HTTP_OK);
    }

    /**
     * DELETE /api/products/{product}
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->noContent(); // 204
    }
}
