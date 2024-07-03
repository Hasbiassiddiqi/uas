@extends('layouts.hotelier')

@section('content')
    <div class="container mt-5">
        <div class="receipt">
            <h1 class="text-center">Order Success</h1>
            <p class="text-center">Your order has been successfully placed.</p>
            <hr>
            <h3>Order Details</h3>
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
            <hr>
            <h5>Total Price: Rp. {{ number_format($totalAmount, 0, ',', '.') }}</h5>
            <p>Discount from Points: Rp. {{ number_format($pointsValue, 0, ',', '.') }}</p>
            <p>Tax (11%): Rp. {{ number_format($tax, 0, ',', '.') }}</p>
            <h3>Grand Total: Rp. {{ number_format($totalAmountWithTax, 0, ',', '.') }}</h3>
            <hr>
            <div class="text-center">
                <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">Back to Home</a>
            </div>
        </div>
    </div>

    <style>
        .receipt {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
            background: #fff;
        }

        .receipt h1,
        .receipt h3,
        .receipt h5,
        .receipt p {
            margin: 0;
            padding: 5px 0;
        }

        .receipt hr {
            border-top: 1px dashed #ddd;
        }
    </style>
@endsection
