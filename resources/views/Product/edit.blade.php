@extends('layouts.app')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    body, .container {
        background-color: #6a0dad;
        font-family: Arial, sans-serif;
        color: #fff;
    }

    .container {
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 100%;
        margin: auto;
        padding-bottom: 120px;
    }

    .btn, .form-control {
        border-radius: 10px;
        border: none;
        color: #fff;
        background-color: #6a0dad;
    }

    .btn:hover {
        background-color: #5d3fd3;
    }

    .form-control {
        margin-bottom: 15px;
        background-color: #8a2be2;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
    }

    .card {
        background-color: #9370db;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 15px;
        color: #000;
    }

    .card img {
        border-radius: 10px;
        max-width: 100%;
    }

    .button-group {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .list-view .product-item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .list-view .product-item .card {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }

    .list-view .product-item .card img {
        width: 100px;
        height: 100px;
        margin-bottom: 15px;
    }

    .alert-info {
        background-color: #d8bfd8;
        border-color: #dda0dd;
        color: #4b0082;
    }

    .list-group-item {
        background-color: #dda0dd;
        border-color: #ba68c8;
        color: #4b0082;
    }

    .popup-message {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #4b0082;
        color: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        opacity: 0;
        transition: opacity 0.5s, transform 0.5s;
        z-index: 1000;
        max-width: 90%;
        width: auto;
    }

    .popup-message.show {
        opacity: 1;
        transform: translate(-50%, -50%);
    }

    .popup-message .close-btn {
        background: none;
        border: none;
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        position: absolute;
        top: 5px;
        right: 10px;
    }

    @media (max-width: 576px) {
        .popup-message {
            padding: 10px;
        }

        .popup-message .close-btn {
            font-size: 16px;
        }
    }

    .bottom-navbar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgb(84, 63, 100);
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 10px 0;
        box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }

    .bottom-navbar a {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-decoration: none;
        font-size: 14px;
        padding: 5px;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .bottom-navbar a:hover {
        color: #FFD700;
        transform: scale(1.1);
    }

    .bottom-navbar i {
        font-size: 20px;
        margin-bottom: 4px;
    }

    .bottom-navbar span {
        font-size: 12px;
    }

    .container {
        padding-bottom: 40px;
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

        <button type="submit" class="btn btn-warning mt-3">Update</button>

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