@extends('layout.app')
@section('content')
<h1>Bandar Hilir Local Food & Tourism Experiences</h1>
<p>Discover local food, vendors and tourism experiences in Bandar Hilir, Melaka.</p>
<h1>Edit Food Experience</h1>

<form method="POST" action="{{ route('products.update', $product) }}">
    @csrf
    @method('PUT')

    <div class="form-grid">

        <div>
            <label>Vendor Name:</label>
            <input type="text" name="vendor_name" value="{{ $product->vendor_name }}">
        </div>

        <div>
            <label>Vendor Location:</label>
            <input type="text" name="vendor_location" value="{{ $product->vendor_location }}">
        </div>

        <div>
            <label>Food Name:</label>
            <input type="text" name="food_name" value="{{ $product->name }}">
        </div>

        <div>
            <label>Food Category:</label>
            <select name="food_category">
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
            <input type="text" name="food_description" value="{{ $product->description }}">
        </div>

        <div>
            <label>Food Price (RM):</label>
            <input type="number" name="food_price" value="{{ $product->price }}" min="0.01" step="0.01" required>
        </div>

    </div>

    <button type="submit">Update</button>

</form>

@endsection
