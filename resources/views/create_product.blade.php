@extends('layout.app')
@section('content')

<h1>Bandar Hilir Local Food & Tourism Experiences</h1>
<p>Discover local food, vendors and tourism experiences in Bandar Hilir, Melaka.</p>

<img src="{{ asset('images/custregist.jpg') }}" class="banner" alt="Food Banner" width="1200" height="600">

<h1>Add New Food Experience</h1>

<form method="POST" action="{{ route('products.store') }}" id="foodForm">
    @csrf

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color:red">{{ $error }}</p>
        @endforeach
    @endif

    <div class="form-grid">
        <div>
            <label>Vendor Name:</label>
            <input type="text" name="vendor_name" id="vendor_name"
                   value="{{ old('vendor_name') }}" required>
        </div>

        <div>
            <label>Vendor Location:</label>
            <input type="text" name="vendor_location" id="vendor_location"
                   value="{{ old('vendor_location') }}" required>
        </div>

        <div>
            <label>Food Name:</label>
            <input type="text" name="food_name" id="food_name"
                   value="{{ old('food_name') }}" required>
        </div>

        <div>
            <label>Food Category:</label>
            <select name="food_category" id="food_category" required>
                <option value="">Choose Food Category</option>
                <option value="Traditional Food">Traditional Food</option>
                <option value="Nyonya Food">Nyonya Food</option>
                <option value="Street Food">Street Food</option>
                <option value="Desserts">Desserts</option>
                <option value="Beverages">Beverages</option>
                <option value="Snacks">Snacks</option>
                <option value="Western Food">Western Food</option>
            </select>
        </div>

        <div>
            <label>Food Description:</label>
            <input type="text" name="food_description" id="food_description"
                   value="{{ old('food_description') }}" required>
        </div>

        <div>
            <label>Food Price:</label>
            <input type="number" name="food_price" id="food_price"
                   value="{{ old('food_price') }}"
                   min="0.01" step="0.01" required>
        </div>
    </div>

    <button type="submit">Save</button>
</form>

@endsection
