@extends('layouts.hotelier')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Add New Product</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="hotel_id">Hotel</label>
                <select name="hotel_id" class="form-control" required>
                    @foreach ($hotels as $hotel)
                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" class="form-control" required>
                    <option value="Standar">Standar</option>
                    <option value="Deluxe">Deluxe</option>
                    <option value="Superior">Superior</option>
                    <option value="Suite">Suite</option>
                    <option value="Single Room">Single Room</option>
                    <option value="Double Room">Double Room</option>
                    <option value="Family Room">Family Room</option>
                </select>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="available_room">Available Room</label>
                <input type="number" name="available_room" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>

        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to Products</a>
    </div>
@endsection
