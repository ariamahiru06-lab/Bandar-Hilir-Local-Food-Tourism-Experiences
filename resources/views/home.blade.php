
@extends('layout.app')

@section('content')

<!-- Hero Section -->
<section class="home-hero">
    <img src="{{ asset('images/nii.jpg') }}" class="banner" 
         alt="Bandar Hilir Shop Banner">

    <div class="hero-text">
        <h1>Discover Bandar Hilir</h1>
        <p>
            Discover local food and vendors in
            Bandar Hilir, Melaka.
        </p>

        <a href="{{ route('products.index') }}" class="home-btn">
            Explore Products
        </a>
    </div>
</section>

<!-- Welcome Section -->
<section class="welcome-section">
    <h2>Welcome, {{ auth()->user()->name }}!</h2>

    @if(auth()->user()->role == 'admin')
        <p>You are logged in as Admin.</p>
    @elseif(auth()->user()->role == 'guest')
        <p>Welcome, Guest User!</p>
    @else
        <p>Welcome, Valued User!</p>
    @endif
</section>

<!-- About Section -->
<section class="welcome-section">
    <h2>About Our Website</h2>
    <p>
        Bandar Hilir Local Food & Tourism Experiences
        is a platform that helps visitors discover local
        food and vendors in Bandar Hilir, Melaka.
        Explore different food products, learn about
        vendors and find their locations.
    </p>
</section>

<!-- Explore Section -->
<section class="home-features">
    <h2>Explore Bandar Hilir</h2>

    <div class="feature-container">

        <div class="feature-card">
            <h3>Local Food</h3>
            <p>
                Discover various local food and traditional
                delicacies available in Bandar Hilir.
            </p>
        </div>

        <div class="feature-card">
            <h3>Local Vendors</h3>
            <p>
                Explore local vendors and learn more
                about their food products and locations.
            </p>
        </div>

        <div class="feature-card">
            <h3>Food Experiences</h3>
            <p>
                Find interesting food options and explore
                the local food scene in Bandar Hilir.
            </p>
        </div>

    </div>

    <a href="{{ route('products.index') }}" class="home-btn">
        View Products
    </a>
</section>

@endsection
