<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Hotel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $hotels = Hotel::all();
        return view('products.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'hotel_id' => 'required|exists:hotels,id',
            'type' => 'required|in:Standar,Deluxe,Superior,Suite,Single Room,Double Room,Family Room',
            'price' => 'required|numeric',
            'available_room' => 'required|numeric',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $hotels = Hotel::all();
        return view('products.edit', compact('product', 'hotels'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'hotel_id' => 'required|exists:hotels,id',
            'type' => 'required|in:Standar,Deluxe,Superior,Suite,Single Room,Double Room,Family Room',
            'price' => 'required|numeric',
            'available_room' => 'required|numeric',
        ]);

        $product->update($request->all());

        return redirect()->route('hotels.show', $product->hotel_id)
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('hotels.show', $product->hotel_id)
            ->with('success', 'Product deleted successfully.');
    }
}
