@extends('layouts.hotelier')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">List of Facilities</h1>
        
        <a href="{{ route('facilities.create') }}" class="btn btn-primary mb-4">Add Facility</a>

        <div class="row">
            @foreach ($facilities as $facility)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ $facility->name }}</h5>
                            <p class="card-text">{{ $facility->description }}</p>
                            <p class="card-text"><strong>Product:</strong> {{ $facility->product->name }}</p>
                            
                            <a href="{{ route('facilities.edit', $facility->id) }}" class="btn btn-primary">Edit</a>

                            <!-- Delete Button -->
                            <form action="{{ route('facilities.destroy', $facility->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Facility?');">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
