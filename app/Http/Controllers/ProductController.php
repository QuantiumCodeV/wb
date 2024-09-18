<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,bmp|max:20480', // Изображения до 20MB
            'sales' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $images[] = $path;
            }
        }

        $validateData = array_merge($validated, ['images' => $images]);

        $product = Product::create($validateData);

        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:jpg,jpeg,png,bmp|max:20480', // Изображения до 20MB
            'sales' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $images = $product->images;
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $images[] = $path;
            }
        }

        $validateData = array_merge($validated, ['images' => $images]);

        $product->update($validateData);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    public function addToFavorites(Request $request, Product $product)
    {
        $user = auth()->user();
        if (!$user->favoriteProducts()->where('product_id', $product->id)->exists()) {
            $user->favoriteProducts()->attach($product->id);
        }
        return response()->json(['success' => 'Product added to favorites']);
    }

    public function removeFromFavorites(Request $request, Product $product){
        $user = auth()->user();
        if ($user->favoriteProducts()->where('product_id', $product->id)->exists()) {
            $user->favoriteProducts()->detach($product->id);
        }
        return response()->json(['success' => 'Product removed from favorites']);
    }

}
