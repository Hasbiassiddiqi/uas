@extends('layouts.hotelier')

@section('content')
    <div class="container py-5">
        <h1>Add Facility</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('facilities.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="product_id">Product</label>
                <select name="product_id" class="form-control" required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Facility</button>
        </form>

        <a href="{{ route('facilities.index') }}" class="btn btn-secondary mt-3">Back to Facilities</a>
    </div>
@endsection
