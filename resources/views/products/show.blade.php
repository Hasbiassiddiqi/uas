@extends('layouts.hotelier')

@section('content')
    <div class="container mt-5">
        <h1>{{ $product->name }} Details</h1>
        @foreach ($product->images as $image)
            <img src="{{ $image->image_url }}" alt="{{ $product->name }}" style="width: 500px; height: auto;">
        @endforeach

        <p class="mt-3">Price: Rp. {{ $product->price }}</p>
        <p>Type: {{ $product->type }}</p>

        <h2>Facilities:</h2>
        @canany(['owner-only', 'staff-only'])
            <a href="{{ route('facilities.create') }}" class="btn btn-primary mb-4">Add Facility</a>
        @endcanany
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    @canany(['owner-only', 'staff-only'])
                        <th scope="col">Actions</th>
                    @endcanany
                </tr>
            </thead>
            <tbody>
                @foreach ($product->facilities as $facility)
                    <tr>
                        <td>{{ $facility->name }}</td>
                        <td>{{ $facility->description }}</td>
                        @canany(['owner-only', 'staff-only'])
                            <td>
                                <a href="{{ route('facilities.edit', $facility->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('facilities.destroy', $facility->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this facility?')">Delete</button>
                                </form>
                            </td>
                        @endcanany
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Back to Products</a>
    </div>
@endsection
