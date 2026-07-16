<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'price' => 'required|numeric|min:0',
            'tax' => 'nullable|integer|in:0,5,12,18,28',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Product name is required.',
            'name.min' => 'Product name must be at least 3 characters long.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a number.',
            'tax.integer' => 'Tax rate must be an integer.',
            'tax.in' => 'Tax rate must be one of the predefined rates.',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully.',
            'data' => $product,
        ], 201);
    }

    public function index(Request $request): JsonResponse
    {
        $product = Product::all();

        return response()->json([
            'success' => true,
            'message' => 'Products fetched successfully.',
            'data' => $product,
        ], 200);
    }
}
