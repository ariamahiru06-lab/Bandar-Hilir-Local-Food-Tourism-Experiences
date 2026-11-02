@extends('layout.app')

@section('content')
<div class="review-container">

    <h1>Customer Reviews</h1>

    @if (session('success'))
        <p class="review-success">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div class="review-card">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="review-form">
        <h2>Write a Review</h2>

        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf

            <label>Food Experience:</label>
            <select name="product_id" required>
                @foreach (\App\Models\Product::all() as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->id }} - {{ $product->name }}
                    </option>
                @endforeach
            </select>

            <label>Rating:</label>
            <select name="rating" required>
                <option value="5">5 - Excellent</option>
                <option value="4">4 - Very Good</option>
                <option value="3">3 - Good</option>
                <option value="2">2 - Fair</option>
                <option value="1">1 - Poor</option>
            </select>

            <label>Comment:</label>
            <textarea name="comment" required></textarea>

            <button type="submit">Submit Review</button>
        </form>
    </div>

    <h2>Submitted Reviews</h2>

    @forelse ($reviews as $review)
        <div class="review-card">
            <h3>{{ $review->product->name ?? 'Food Experience' }}</h3>
            <p><strong>Rating:</strong> {{ $review->rating }}/5</p>
            <p><strong>Comment:</strong> {{ $review->comment }}</p>
            <p><strong>By:</strong> {{ $review->user->name ?? 'User' }}</p>
        </div>
    @empty
        <div class="review-card">
            <p>No reviews yet.</p>
        </div>
    @endforelse

    </div>
@endsection