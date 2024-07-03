@extends('layouts.hotelier')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">List of Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-4">Add Product</a>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow">
                        @foreach($product->images as $image)
                            <img src="{{ $image->image_url }}" alt="{{ $product->name }}" style="width: 200px; height: auto;">
                        @endforeach
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text"><strong>Hotel:</strong> {{ $product->hotel->name }}</p>
                            <p class="card-text"><strong>Type:</strong> {{ $product->type }}</p>
                            <p class="card-text"><strong>Price:</strong> Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">View Details</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
