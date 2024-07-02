@extends('layouts.hotelier')

@section('content')
    <div class="container mt-5">
        <h1>{{ $hotel->name }}</h1>
        <img src="{{ $hotel->image_url }}" alt="{{ $hotel->name }}" style="width: 100%; height: auto;">
        <p class="mt-3">{{ $hotel->description }}</p>
        <p>Alamat: {{ $hotel->address }}</p>

        <h2>Products:</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-4">Add Product</a>
        <div class="row mt-3">
            @foreach ($hotel->products as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow rounded h-100 position-relative">
                        <img src="{{ $product->images->first()->image_url }}" class="card-img-top"
                            alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text h3 text-danger">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="card-text text-danger">Available Room:
                                {{ $product->available_room }}</p>
                            <div class="mt-auto">

                                <div class="d-flex align-items-center mb-2 gap-4 justify-content-center">
                                    <button class="btn btn-primary px-3" onclick="decreaseRoom({{ $product->id }})"
                                        id="minusButton{{ $product->id }}">-</button>
                                    <span id="roomCount{{ $product->id }}">0</span>
                                    <button class="btn btn-primary px-3"
                                        onclick="increaseRoom({{ $product->id }}, {{ $product->available_room }})"
                                        id="plusButton{{ $product->id }}">+</button>
                                </div>
                                <a href="{{ route('products.show', $product->id) }}"
                                    class="btn btn-primary w-100 mb-2">Detail Product</a>
                            </div>
                        </div>
                        <div class="position-absolute  bg-primary text-white px-3 py-2"
                            style="border-radius: 10px; top: 10px; right: 10px;">
                            {{ $product->type }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <form id="transactionForm" action="{{ route('transactions.confirm') }}" method="POST">
            @csrf
            <input type="hidden" name="products" id="productsInput">
            <button type="button" id="pesanButton" class="btn btn-success mt-3">Pesan</button>
        </form>

        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Back to Home</a>
    </div>

    <script>
        function decreaseRoom(productId) {
            const roomCountElement = document.getElementById(`roomCount${productId}`);
            let roomCount = parseInt(roomCountElement.innerText);
            if (roomCount > 0) {
                roomCount--;
                roomCountElement.innerText = roomCount;
            } else {
                alert('Jumlah kamar yang dipesan tidak dapat kurang dari 0');
            }
        }

        function increaseRoom(productId, availableRoom) {
            const roomCountElement = document.getElementById(`roomCount${productId}`);
            let roomCount = parseInt(roomCountElement.innerText);
            if (roomCount < availableRoom) {
                roomCount++;
                roomCountElement.innerText = roomCount;
            } else {
                alert('Jumlah kamar yang dipesan melebihi jumlah yang tersedia.');
            }
        }

        document.getElementById('pesanButton').addEventListener('click', function() {
            const products = @json($hotel->products).map(product => {
                const roomCount = parseInt(document.getElementById(`roomCount${product.id}`).innerText);
                if (roomCount > 0) {
                    return {
                        id: product.id,
                        name: product.name,
                        price: product.price,
                        quantity: roomCount
                    };
                }
            }).filter(product => product !== undefined);
            document.getElementById('productsInput').value = JSON.stringify(products);
            document.getElementById('transactionForm').submit();
        });
    </script>
@endsection
