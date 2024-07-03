@extends('layouts.hotelier')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">List of Memberships</h1>
        <a href="{{ route('memberships.create') }}" class="btn btn-primary mb-4">Add Membership</a>
        <div class="row">
            @foreach ($memberships as $membership)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ $membership->user->name }}</h5>
                            <p class="card-text"><strong>Points:</strong> {{ $membership->points }}</p>
                            <p class="card-text"><strong>Total Purchases:</strong> Rp. {{ number_format($membership->total_purchases, 0, ',', '.') }}</p>
                            <a href="{{ route('memberships.show', $membership->id) }}" class="btn btn-primary">View Details</a>
                            <form action="{{ route('memberships.destroy', $membership->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Membership?');">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
