@extends('layouts.hotelier')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Add Membership</h1>
        <form action="{{ route('memberships.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="points">Points</label>
                <input type="number" name="points" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="total_purchases">Total Purchases</label>
                <input type="number" name="total_purchases" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Membership</button>
        </form>
    </div>
@endsection
