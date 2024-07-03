<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return view('hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('hotels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:hotels,email',
            'rating' => 'required|numeric',
            'image_url' => 'required',
            'type' => 'required|in:City Hotel,Residential Hotel,Motel',
        ]);

        Hotel::create($request->all());

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel created successfully.');
    }

    public function show(Hotel $hotel)
    {
        return view('hotels.show', compact('hotel'));
    }

    public function edit(Hotel $hotel)
    {
        return view('hotels.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:hotels,email,' . $hotel->id,
            'rating' => 'required|numeric',
            'image_url' => 'required',
            'type' => 'required|in:City Hotel,Residential Hotel,Motel',
        ]);

        $hotel->update($request->all());

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel updated successfully.');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel deleted successfully.');
    }
    public function dashboardRoom()
    {
        $hotels = Hotel::limit(3)->get();
        // dd($hotels);
        return view('dashboard', compact('hotels'));
    }
}