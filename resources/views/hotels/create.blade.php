@extends('layouts.hotelier')

@section('content')
<div class="page-content">
    <h3 class="page-title">Create New Hotel</h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li><i class="fa fa-home"></i> <a href="/">Home</a> <i class="fa fa-angle-right"></i></li>
            <li><a href="#">Create New Hotel</a></li>
        </ul>
    </div>

    <div class="container">
        <form method="POST" action="{{ route('hotels.store') }}">
            @csrf
            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter Name...">
            </div>
            <div class="form-group">
                <label for="exampleInputAddress">Address</label>
                <input type="text" class="form-control" id="exampleInputAddress" name="address" placeholder="Enter Address...">
            </div>
            <div class="form-group">
                <label for="exampleInputPhone">Phone</label>
                <input type="text" class="form-control" id="exampleInputPhone" name="phone" placeholder="Enter Phone...">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail" name="email" placeholder="Enter Email...">
            </div>
            <div class="form-group">
                <label for="exampleInputRating">Rating</label>
                <input type="number" class="form-control" id="exampleInputRating" name="rating" placeholder="Enter Rating...">
            </div>
            <div class="form-group">
                <label for="exampleInputRating">Image</label>
                <input type="text" class="form-control" id="exampleInputImage" name="image_url" placeholder="Enter Image...">
            </div>
            <div class="form-group">
                <label for="exampleInputType">Type</label>
                <select class="form-control" id="exampleInputType" name="type">
                    <option value="City Hotel">City Hotel</option>
                    <option value="Residential Hotel">Residential Hotel</option>
                    <option value="Motel">Motel</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
