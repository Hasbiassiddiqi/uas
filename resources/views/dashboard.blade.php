@extends('layouts.hotelier')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($hotels as $hotel)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img class="w-100" src="{{ $hotel->image_url }}" alt="{{ $hotel->name }}"
                            style="height: 100vh; object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown"></h6>
                                <h1 class="display-3 text-white mb-4 animated slideInDown">{{ $hotel->name }}</h1>
                                <a href="{{ route('hotels.show', $hotel->id) }}"
                                    class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">View
                                    More</a>
                                <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Book A
                                    Room</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->
    <div class="container py-5">
        <h1 class="mb-4">List of Hotels</h1>
        <div class="row">
            @foreach ($hotels as $hotel)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow rounded h-100">
                        <img src="{{ $hotel->image_url }}" class="card-img-top" alt="{{ $hotel->name }}"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $hotel->name }}</h5>
                            <p class="card-text">{{ $hotel->description }}</p>
                            <p class="card-text"><strong>Address:</strong> {{ $hotel->address }}</p>
                            <p class="card-text"><strong>Rating:</strong> {{ $hotel->rating }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-primary w-100 mb-2">View
                                    Details</a>
                                @canany(['owner-only', 'staff-only'])
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-secondary">Edit</a>
                                        <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST"
                                            class="d-inline-block ">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this hotel?');">Delete</button>
                                        </form>
                                    </div>
                                @endcanany
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
