@extends('layouts.app')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    body {
        color: #fff; /* Default text color for the entire page */
    }

    .container {
        background-color: rgb(121, 56, 173); /* Dark purple background for the container */
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 600px; /* Limit the width for better readability */
        margin: auto; /* Center the container */
    }

    .btn-secondary, .btn-primary, .btn-success, .btn-warning, .btn-danger {
        background-color: #4b0082; /* Dark purple button color */
        border: none;
        color: #fff; /* White text color */
    }

    .btn-secondary:hover, .btn-primary:hover, .btn-success:hover, .btn-warning:hover, .btn-danger:hover {
        background-color: #2e0854; /* Darker purple on hover */
    }

    .form-group label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #dcdcdc;
        margin-bottom: 15px; /* Add space between form controls */
        background-color: #4b0082; /* Dark purple background for form controls */
        color: #fff; /* White text color */
    }

    .form-control::placeholder {
        color: #dcdcdc; /* Light grey placeholder text */
    }

    /* Override text color for BrandName input field */
    .form-control[name="BrandName"] {
        color: #000; /* Black text color for BrandName input */
    }

    .btn {
        border-radius: 10px;
    }

    h1 {
        text-align: center; /* Center the heading */
        margin-bottom: 30px; /* Add space below the heading */
    }

    /* Calendar Styling */
    input[type="date"] {
        position: relative;
        padding: 10px;
        border-radius: 10px;
        border: 1px solid rgb(148, 64, 64);
        background-color: rgb(156, 110, 189); /* Dark purple background */
        color: #fff; /* White text color */
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1); /* Invert colors for better visibility */
    }

    /* Centering buttons */
    .button-group {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px; /* Space between buttons */
    }

    @media (min-width: 576px) {
        .button-group {
            flex-direction: row;
        }
    }

    /* Pop-up message styling */
    .popup {
        position: fixed;
        bottom: -100px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #4b0082;
        color: #fff;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: bottom 0.5s;
        z-index: 1000;
        animation: slideIn 0.5s forwards; /* Add animation */
    }

    .popup.show {
        bottom: 20px;
    }

    .popup .close-btn {
        background: none;
        border: none;
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        position: absolute;
        top: 5px;
        right: 10px;
    }

    /* Define the slide-in animation */
    @keyframes slideIn {
        from {
            bottom: -100px;
            opacity: 0;
        }
        to {
            bottom: 20px;
            opacity: 1;
        }
    }

    /* Define the slide-out animation */
    @keyframes slideOut {
        from {
            bottom: 20px;
            opacity: 1;
        }
        to {
            bottom: -100px;
            opacity: 0;
        }
    }

    .popup.slide-out {
        animation: slideOut 0.5s forwards;
    }

    /* General Bottom Navbar Styles */
    .bottom-navbar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgb(84, 63, 100); /* Indigo color */
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 10px 0;
        box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }

    .bottom-navbar a {
        display: flex;
        flex-direction: column; /* Align icons above text */
        justify-content: center;
        align-items: center;
        color: white;
        text-decoration: none;
        font-size: 14px;
        padding: 5px;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .bottom-navbar a:hover {
        color: #FFD700; /* Gold color for hover */
        transform: scale(1.1); /* Slightly enlarge on hover */
    }

    .bottom-navbar i {
        font-size: 20px; /* Icon size */
        margin-bottom: 4px; /* Space between icon and text */
    }

    .bottom-navbar span {
        font-size: 12px; /* Text size below the icons */
    }

    /* Make sure the page content doesn't overlap the navbar */
    .container {
        padding-bottom: 80px; /* Adjusted padding to the bottom */
    }
</style>

@section('content')
<div class="container">
    <h1>Edit Product</h1>
    <form action="{{ route('Product.update', $product->ProductID) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="BrandName">Brand Name</label>
            <input type="text" name="BrandName" class="form-control" value="{{ old('BrandName', $product->BrandName) }}" required>
            @error('BrandName')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="PurchasedDate">Purchased Date</label>
            <input type="date" name="PurchasedDate" class="form-control" value="{{ old('PurchasedDate', $product->PurchasedDate) }}" required>
            @error('PurchasedDate')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="OpenDate">Open Date</label>
            <input type="date" name="OpenDate" class="form-control" value="{{ old('OpenDate', $product->OpenDate) }}" required>
            @error('OpenDate')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="ExpiryDate">Expiry Date</label>
            <input type="date" name="ExpiryDate" class="form-control" value="{{ old('ExpiryDate', $product->ExpiryDate) }}" required>
            @error('ExpiryDate')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Image Upload Field -->
        <div class="form-group">
            <label for="image">Product Image (Optional)</label>
            <input type="file" name="image" class="form-control">
            <!-- Show the current image if available -->
            @if($product->image)
                <div class="mt-2">
                    <img src="{{ $product->image }}" alt="Product Image" width="100">
                    <p class="mt-2">Current Image</p>
                </div>
            @endif
            @error('image')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning mt-3">Update Product</button>

        <!-- Cancel button -->
        <a href="{{ route('Product.index') }}" class="btn btn-danger mt-3">
            <i class="fa fa-times-circle mr-2"></i> Cancel
        </a>
    </form>
</div>

<!-- Bottom Navbar -->
<div class="bottom-navbar">
    <a href="{{ route('Aboutus.index') }}">
        <i class="fas fa-info-circle"></i>
        <span>About Us</span>
    </a>
    <a href="{{ route('home') }}">
        <i class="fas fa-home"></i>
        <span>Home</span>
    </a>
    <a href="{{ route('Tips.index') }}">
        <i class="fas fa-lightbulb"></i>
        <span>Tips</span>
    </a>
</div>
@endsection
