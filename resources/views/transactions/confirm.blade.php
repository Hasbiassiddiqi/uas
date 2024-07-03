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

        <form action="{{ route('transactions.simpan') }}" method="POST">
            @csrf
            <input type="hidden" name="products" value="{{ json_encode($products) }}">
            <div class="form-group">
                <label for="points">Use Points (Available: {{ $points }})</label>
                <input type="number" name="points" class="form-control" value="0" min="0"
                    max="{{ $points }}" id="pointsInput">
            </div>
            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
            <h5>Total Price: Rp. <span id="totalPrice">{{ number_format($totalPrice, 0, ',', '.') }}</span></h5>
            <p>Discount from Points: Rp. <span id="pointsDiscount">0</span></p>
            <p>Tax (11%): Rp. <span id="tax">{{ number_format($totalPrice * 0.11, 0, ',', '.') }}</span></p>
            <h3>Grand Total: Rp. <span
                    id="grandTotal">{{ number_format($totalPrice + $totalPrice * 0.11, 0, ',', '.') }}</span></h3>
            <button type="submit" class="btn btn-success">Confirm Order</button>
        </form>

        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>
    </div>

    <script>
        document.getElementById('pointsInput').addEventListener('input', function() {
            const points = parseInt(this.value) || 0;
            const maxPoints = {{ $points }};
            if (points > maxPoints) {
                alert('Points melebihi jumlah yang dimiliki.');
                this.value = maxPoints;
            }
            const totalPrice = {{ $totalPrice }};
            const pointsValue = points * 100000;
            const newTotalPrice = totalPrice - pointsValue;
            const tax = newTotalPrice * 0.11;
            const grandTotal = newTotalPrice + tax;

            if (newTotalPrice < 0) {
                alert('Total price sudah 0, tidak dapat menggunakan point lagi.');
                this.value = Math.floor(totalPrice / 100000);
                document.getElementById('totalPrice').innerText = '0';
                document.getElementById('pointsDiscount').innerText = '0';
                document.getElementById('tax').innerText = '0';
                document.getElementById('grandTotal').innerText = '0';
            } else {
                document.getElementById('totalPrice').innerText = new Intl.NumberFormat('id-ID').format(
                    newTotalPrice);
                document.getElementById('pointsDiscount').innerText = new Intl.NumberFormat('id-ID').format(
                    pointsValue);
                document.getElementById('tax').innerText = new Intl.NumberFormat('id-ID').format(tax);
                document.getElementById('grandTotal').innerText = new Intl.NumberFormat('id-ID').format(grandTotal);
            }
        });
    </script>
@endsection
