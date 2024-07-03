@extends('layouts.hotelier')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">Create Transaction</h1>
                        <form action="{{ route('transactions.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select name="user_id" class="form-control" required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <h3>Select Product</h3>
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="col-12 mb-4">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <img src="{{ $product->images->first()->image_url }}"
                                                            class="img-fluid rounded" alt="Product Image">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h5 class="card-title">{{ $product->name }}</h5>
                                                        <p class="card-text"><strong>Type:</strong> {{ $product->type }}</p>
                                                        <p class="card-text"><strong>Price:</strong> Rp.
                                                            {{ number_format($product->price, 0, ',', '.') }}</p>
                                                        <div class="form-group">
                                                            <label for="quantity_{{ $product->id }}">Quantity</label>
                                                            <input type="number"
                                                                name="products[{{ $product->id }}][quantity]"
                                                                class="form-control" min="1" value="1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label for="redeem_points">Redeem Points</label>
                                <input type="number" name="redeem_points" class="form-control" min="0"
                                    max="{{ $user->membership->points ?? 0 }}" value="0">
                            </div>

                            <button type="submit" class="btn btn-primary">Create Transaction</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
