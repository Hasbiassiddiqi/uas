<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Product;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::with('product')->get();
        return view('facilities.index', compact('facilities'));
    }

    public function create()
    {
        $products = Product::all();
        return view('facilities.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required',
            'description' => 'nullable',
        ]);

        Facility::create($request->all());

        return redirect()->route('facilities.index')
            ->with('success', 'Facility created successfully.');
    }

    public function show(Facility $facility)
    {
        return view('facilities.show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        $products = Product::all();
        return view('facilities.edit', compact('facility', 'products'));
    }

    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $facility->update($request->all());

        return redirect()->route('products.show', $facility->product_id)
            ->with('success', 'Facility updated successfully.');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('products.show', $facility->product_id)
            ->with('success', 'Facility deleted successfully.');
    }
}
