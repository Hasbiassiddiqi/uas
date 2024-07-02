@extends('layouts.hotelier')

@section('content')
    <div class="container mt-5">
        <h1>Order Confirmation</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>Rp. {{ number_format($product['price'], 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($product['price'] * $product['quantity'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3>Total Price: Rp. {{ number_format($totalPrice, 0, ',', '.') }}</h3>

        <form action="{{ route('transactions.simpan') }}" method="POST">
            @csrf
            <input type="hidden" name="products" value="{{ json_encode($products) }}">
            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
            <button type="submit" class="btn btn-success">Confirm Order</button>
        </form>

        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>
    </div>
@endsection
