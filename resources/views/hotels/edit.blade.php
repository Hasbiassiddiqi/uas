@extends('layouts.hotelier')

@section('content')
    <div class="container mt-5">
        <h1>Edit Hotel</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('hotels.update', $hotel->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $hotel->name }}" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" value="{{ $hotel->address }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $hotel->phone }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $hotel->email }}" required>
            </div>

            <div class="form-group">
                <label for="rating">Rating</label>
                <input type="number" name="rating" class="form-control" value="{{ $hotel->rating }}" required>
            </div>

            <div class="form-group">
                <label for="image_url">Image URL</label>
                <input type="text" name="image_url" class="form-control" value="{{ $hotel->image_url }}" required>
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" class="form-control" required>
                    <option value="City Hotel" {{ $hotel->type == 'City Hotel' ? 'selected' : '' }}>City Hotel</option>
                    <option value="Residential Hotel" {{ $hotel->type == 'Residential Hotel' ? 'selected' : '' }}>Residential Hotel</option>
                    <option value="Motel" {{ $hotel->type == 'Motel' ? 'selected' : '' }}>Motel</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Hotel</button>
        </form>

        <a href="/" class="btn btn-secondary mt-3">Back to Hotels</a>
    </div>
@endsection
