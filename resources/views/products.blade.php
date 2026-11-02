
@extends('layout.app')

@section('content')

<h1>Bandar Hilir Local Food & Tourism Experiences</h1>

<p>Discover local food, vendors and tourism experiences in Bandar Hilir, Melaka.</p>

<img src="{{ asset('images/home.jpg') }}"
     class="banner"
     alt="Food Banner"
     width="1200"
     height="600">

<h1>Food Experience List</h1>

@if(auth()->check() && auth()->user()->role === 'admin')
    <a href="{{ route('products.create') }}" class="add-btn">
        Add New Product
    </a>
@endif

{{-- Search Food Experiences --}}
<form action="{{ route('products.index') }}" method="GET" class="search-form">
    <input
        type="text"
        name="search"
        placeholder="Search food, category or vendor..."
        value="{{ request('search') }}"
    >

    <button type="submit">Search</button>

    <a href="{{ route('products.index') }}">Reset</a>
</form>

@if($products->isEmpty())

    <p>No food experiences available.</p>

@else

    @foreach($products as $product)

        <div class="product-card">

            <h3>{{ $product->name }}</h3>

            <p><strong>Vendor:</strong> {{ $product->vendor_name }}</p>
            <p><strong>Location:</strong> {{ $product->vendor_location }}</p>
            <p><strong>Category:</strong> {{ $product->category }}</p>
            <p><strong>Description:</strong> {{ $product->description }}</p>
            <p><strong>Price:</strong> RM{{ $product->price }}</p>

            @if(auth()->check() && auth()->user()->role === 'admin')

                <div class="product-actions">

                    <a href="{{ route('products.edit', $product) }}" class="edit-btn">
                        Edit
                    </a>

                    <form action="{{ route('products.destroy', $product) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit">Delete</button>
                    </form>

                </div>

            @endif

        </div>

    @endforeach

@endif

@endsection
