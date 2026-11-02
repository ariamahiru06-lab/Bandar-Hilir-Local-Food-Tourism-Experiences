<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display and search Food Experiences
    public function index(Request $request)
    {
        $products = Product::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('category', 'like', "%{$search}%")
                      ->orWhere('vendor_name', 'like', "%{$search}%")
                      ->orWhere('vendor_location', 'like', "%{$search}%");
                });
            })
            ->get();

        return view('products', compact('products'));
    }

    // Show create form
    public function create()
    {
        return view('create_product');
    }

    // Store new Food Experience
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vendor_name' => 'required|string|max:255',
            'vendor_location' => 'required|string|max:255',
            'food_name' => 'required|string|max:255',
            'food_category' => 'required|string|max:255',
            'food_description' => 'required|string',
            'food_price' => 'required|numeric|min:0'
        ]);

        Product::create([
            'vendor_name' => $validated['vendor_name'],
            'vendor_location' => $validated['vendor_location'],
            'name' => $validated['food_name'],
            'category' => $validated['food_category'],
            'description' => $validated['food_description'],
            'price' => $validated['food_price']
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Food Experience added!');
    }

    // Show edit form
    public function edit(Product $product)
    {
        return view('edit_product', compact('product'));
    }

    // Update Food Experience
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'vendor_name' => 'required|string|max:255',
            'vendor_location' => 'required|string|max:255',
            'food_name' => 'required|string|max:255',
            'food_category' => 'required|string|max:255',
            'food_description' => 'required|string',
            'food_price' => 'required|numeric|min:0'
        ]);

        $product->update([
            'vendor_name' => $validated['vendor_name'],
            'vendor_location' => $validated['vendor_location'],
            'name' => $validated['food_name'],
            'category' => $validated['food_category'],
            'description' => $validated['food_description'],
            'price' => $validated['food_price']
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Food Experience updated!');
    }

    // Delete Food Experience
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted!');
    }
}
