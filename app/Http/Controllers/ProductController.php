<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function delete(Request $request)
    {
        $products = $request->input('products');
        Product::whereIn('id', $products)->delete();
        return response()->json(['success' => 'Products deleted successfully']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,bmp|max:20480', // Изображения до 20MB
            'sales' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'custom_field_name' => 'nullable|array',
            'custom_field_value' => 'nullable|array',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $images[] = $path;
            }
        }

        $customFields = [];
        if ($request->has('custom_field_name') && $request->has('custom_field_value')) {
            foreach ($request->custom_field_name as $index => $name) {
                $customFields[] = [
                    'name' => $name,
                    'value' => $request->custom_field_value[$index] ?? '',
                ];
            }
        }

        $validateData = array_merge($validated, ['images' => $images, 'custom_fields' => $customFields]);

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
            'custom_field_name' => 'nullable|array',
            'custom_field_value' => 'nullable|array',
        ]);

        $validateData = $validated;

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $images[] = $path;
            }
            $validateData['images'] = $images;
        }

        $customFields = [];
        if ($request->has('custom_field_name') && $request->has('custom_field_value')) {
            foreach ($request->custom_field_name as $index => $name) {
                $customFields[] = [
                    'name' => $name,
                    'value' => $request->custom_field_value[$index] ?? '',
                ];
            }
            $validateData = array_merge($validated, ['custom_fields' => $customFields]);
        }

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

    public function removeFromFavorites(Request $request, Product $product)
    {
        $user = auth()->user();
        if ($user->favoriteProducts()->where('product_id', $product->id)->exists()) {
            $user->favoriteProducts()->detach($product->id);
        }
        return response()->json(['success' => 'Product removed from favorites']);
    }
}
