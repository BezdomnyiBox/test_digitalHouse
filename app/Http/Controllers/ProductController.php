<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Эндпоинт для получения каталога с пагинацией и фильтрацией
    public function index(Request $request)
    {
         $query = Product::with('characteristics');

        // Фильтрация по цене
        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }
        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }

        // Фильтрация по характеристикам
        if ($request->has('characteristics')) {
            $characteristics = $request->input('characteristics');
            $query->whereHas('characteristics', function ($q) use ($characteristics) {
                foreach ($characteristics as $key => $value) {
                    $q->where('key', $key)->where('value', $value);
                }
            });
        }

        $products = $query->paginate(10);

        return response()->json($products);
    }

    // Эндпоинт для получения информации о товаре
    public function show($id)
    {
        $product = Product::with('characteristics', 'reviews')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Товар не найден'], 404);
        }

        return response()->json($product);
    }

    // Эндпоинт для добавления отзыва
    public function addReview(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Товар не найден'], 404);
        }

        $data = $request->validate([
            'author' => 'required|string',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = $product->reviews()->create($data);

        return response()->json($review, 201);
    }
}

