<!DOCTYPE html>
<html>
<head>
    <title>E-Commerce</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="@if(request()->routeIs('login', 'register')) auth-page @endif">

    <nav>
        <a href="{{ url('/home') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="BH Logo">
        </a>

        <a href="{{ url('/home') }}">Home</a>
        <a href="{{ url('/products') }}">Food Experiences</a>
        <a href="{{ url('/products/create') }}">Add Food Experiences</a>
        <a href="{{ url('/reviews') }}">Reviews</a>
        <a href="{{ url('/contact') }}">Contact</a>

        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endauth
    </nav>

    <div class="content">
        @yield('content')
    </div>

    <footer>
        <p>&copy; 2026 Bandar Hilir Local Food & Tourism Experiences.
        All Rights Reserved.</p>
    </footer>

</body>
</html>