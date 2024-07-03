@extends('layouts.hotelier')

@section('content')
    <div class="container py-5">
        <h1>Edit Product</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>

            <div class="form-group">
                <label for="hotel_id">Hotel</label>
                <select name="hotel_id" class="form-control" required>
                    @foreach ($hotels as $hotel)
                        <option value="{{ $hotel->id }}" {{ $hotel->id == $product->hotel_id ? 'selected' : '' }}>{{ $hotel->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" class="form-control" required>
                    <option value="Standar" {{ $product->type == 'Standar' ? 'selected' : '' }}>Standar</option>
                    <option value="Deluxe" {{ $product->type == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                    <option value="Superior" {{ $product->type == 'Superior' ? 'selected' : '' }}>Superior</option>
                    <option value="Suite" {{ $product->type == 'Suite' ? 'selected' : '' }}>Suite</option>
                    <option value="Single Room" {{ $product->type == 'Single Room' ? 'selected' : '' }}>Single Room</option>
                    <option value="Double Room" {{ $product->type == 'Double Room' ? 'selected' : '' }}>Double Room</option>
                    <option value="Family Room" {{ $product->type == 'Family Room' ? 'selected' : '' }}>Family Room</option>
                </select>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
            </div>

            <div class="form-group">
                <label for="available_room">Available Room</label>
                <input type="number" name="available_room" class="form-control" value="{{ $product->available_room }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>

        <a href="{{ route('hotels.show',  $product->hotel_id) }}" class="btn btn-secondary mt-3">Back to Products</a>
    </div>
@endsection
