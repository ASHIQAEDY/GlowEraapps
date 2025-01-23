@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    /* General Styles */
    body {
        background-color: #4b0082; /* Dark purple background for the entire page */
        color: #fff; /* White text color */
        font-family: Arial, sans-serif;
    }

    .container {
        background-color: #6a0dad; /* Slightly lighter purple for the container */
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 100%; /* Full width for better readability on mobile */
        margin: auto; /* Center the container */
        padding-bottom: 120px; /* Increased padding to the bottom */
    }

    .btn-secondary, .btn-primary, .btn-success {
        background-color: #8a2be2; /* Bright purple button color */
        border: none;
        color: #fff; /* White text color */
    }

    .btn-secondary:hover, .btn-primary:hover, .btn-success:hover {
        background-color: #5d3fd3; /* Darker purple on hover */
    }

    .form-group label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #dcdcdc;
        margin-bottom: 15px; /* Add space between form controls */
        background-color: #8a2be2; /* Bright purple background for form controls */
        color: #fff; /* White text color */
    }

    .form-control::placeholder {
        color: #dcdcdc; /* Light grey placeholder text */
    }

    .btn {
        border-radius: 10px;
    }

    h1 {
        text-align: center; /* Center the heading */
        margin-bottom: 30px; /* Add space below the heading */
        color: #fff; /* White text color */
    }

    /* Card Styling */
    .card {
        background-color: #9370db; /* Medium purple background for the card */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 15px;
    }

    .card-title, .card-text {
        color: rgb(0, 0, 0); /* Black text color for card content */
    }

    /* Image Styling */
    .card img {
        border-radius: 10px;
        max-width: 100%; /* Ensure image fits within the card */
    }

    /* Centering buttons */
    .button-group {
        display: flex;
        justify-content: center; /* Center the buttons */
        gap: 10px; /* Space between buttons */
    }

    /* List View */
    .list-view .product-item {
        display: flex;
        flex-direction: column; /* Display products vertically */
        align-items: center;
    }

    .list-view .product-item .card {
        display: flex;
        flex-direction: column; /* Display card content vertically */
        align-items: center;
        width: 100%;
    }

    .list-view .product-item .card img {
        width: 100px;
        height: 100px;
        margin-bottom: 15px; /* Space below image */
    }

    .list-view .product-item .card-body {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .alert.alert-info {
        background-color: #d8bfd8; /* Light purple background */
        border-color: #dda0dd; /* Purple border */
        color: #4b0082; /* Dark purple text */
    }

    .list-group-item {
        background-color: #dda0dd; /* Light purple background for list items */
        border-color: #ba68c8; /* Purple border for list items */
        color: #4b0082; /* Dark purple text for list items */
    }

    .btn.btn-primary {
        background-color: #8e24aa; /* Purple button background */
        border-color: #6a1b9a; /* Purple button border */
    }

    .btn.btn-primary:hover {
        background-color: #6a1b9a; /* Darker purple on hover */
        border-color: #4a148c; /* Darker purple border on hover */
    }

    .popup-message {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #4b0082;
        color: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        opacity: 0;
        transform: translateY(100%);
        transition: opacity 0.5s, transform 0.5s;
        z-index: 1000;
    }

    .popup-message.show {
        opacity: 1;
        transform: translateY(0);
    }

    /* General Bottom Navbar Styles */
    .bottom-navbar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #6a0dad; /* Indigo color */
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
        padding-bottom: 120px; /* Adjusted padding to the bottom */
    }
</style>

@section('content')
<div class="container">
    <!-- Navigation Back to Home -->
    <a href="{{ route('home') }}" class="btn btn-secondary mb-3">
        <i class="fa fa-home"></i> Back to Home
    </a>

    <h1 class="mb-4">Product</h1>

    @if(session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif

    <!-- Search Form -->
    <form method="GET" action="{{ route('Product.index') }}" class="mb-4">
        <div class="row">
            @if(Auth::user()->UserLevel == 0)
                <div class="col-md-3">
                <p class="card-text"><strong>user id:</strong></p>
                    <input type="text" name="userid" class="form-control" placeholder="User ID" value="{{ request('userid') }}">
                </div>
            @endif
            <div class="col-md-3">
            <p class="card-text"><strong>Product Name:</strong></p>
                <input type="text" name="BrandName" class="form-control" placeholder="Product Name" value="{{ request('BrandName') }}">
            </div>
            <div class="col-md-3">
            <p class="card-text"><strong>Purchased Date:</strong></p>
                <input type="date" name="PurchasedDate" class="form-control" placeholder="Purchased Date" value="{{ request('PurchasedDate') }}">
            </div>
            <div class="col-md-3">
            <p class="card-text"><strong>Open Date:</strong></p>
                <input type="date" name="OpenDate" class="form-control" placeholder="Open Date" value="{{ request('OpenDate') }}">
            </div>
            <div class="col-md-3">
            <p class="card-text"><strong>Expiry Date:</strong></p>
                <input type="date" name="ExpiryDate" class="form-control" placeholder="Expiry Date" value="{{ request('ExpiryDate') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <!-- Display Notifications -->
    @if(Auth::user()->notifications->count() > 0)
        <div class="alert alert-info mb-4">
            <h4>Notifications</h4>
            <ul class="list-group">
                @foreach(Auth::user()->notifications as $notification)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            {{ $notification->data['brand_name'] }} is about to expire on {{ $notification->data['expiry_date'] }}.
                        </span>
                        <!-- Delete Notification Button -->
                        <form action="{{ route('Product.destroy', $notification->data['product_id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Mobile View Table Conversion -->
    @if($products->isEmpty())
        <div class="alert alert-warning">
            No products found. Please try searching for something else.
        </div>
    @else
        <div class="row list-view" id="productContainer">
            @foreach($products as $product)
                <div class="col-12 col-sm-6 col-md-4 mb-3 product-item">
                    <!-- Card for each product -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Product Name: </strong>{{ $product->BrandName }}</h5>
                            <!-- Show ProductID for UserLevel 0 -->
                            @if(Auth::user()->UserLevel == 0)
                                <p class="card-text"><strong>Product ID:</strong> {{ $product->ProductID }}</p>
                                <p class="card-text"><strong>User ID:</strong> {{ $product->userid }}</p>
                            @endif
                            <p class="card-text">
                                <strong>Purchased Date:</strong> {{ \Carbon\Carbon::parse($product->PurchasedDate)->format('d-m-Y') }}
                            </p>
                            <p class="card-text">
                                <strong>Open Date:</strong> {{ \Carbon\Carbon::parse($product->OpenDate)->format('d-m-Y') }}
                            </p>
                            <p class="card-text">
                                <strong>Expiry Date:</strong> {{ \Carbon\Carbon::parse($product->ExpiryDate)->format('d-m-Y') }}
                            </p>
                            @if($product->image)
                                <p class="card-text"><strong>Image:</strong>
                                    <img src="{{$product->image}}" style="width:70px;height:70px;">
                                </p>
                            @endif

                            <!-- Actions: Edit & Delete -->
                            <div class="button-group">
                                <!-- Edit Button -->
                                <a href="{{ route('Product.edit', $product->ProductID) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('Product.destroy', $product->ProductID) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Popup messages -->
    <div id="popupContainer"></div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const messages = [
            "Welcome to the Product Page!",
            "Here you can view all your products.",
            "Use the Edit button to modify product details.",
            "Use the Delete button to remove a product.",
            "Check your notifications for product expiry alerts."
        ];

        let currentMessageIndex = 0;

        function showNextMessage() {
            if (currentMessageIndex < messages.length) {
                const message = messages[currentMessageIndex];
                const popup = document.createElement('div');
                popup.className = 'popup-message';
                popup.textContent = message;

                document.getElementById('popupContainer').appendChild(popup);

                setTimeout(() => {
                    popup.classList.add('show');
                }, 100);

                setTimeout(() => {
                    popup.classList.remove('show');
                    setTimeout(() => {
                        popup.remove();
                        showNextMessage();
                    }, 500);
                }, 3000);

                currentMessageIndex++;
            }
        }

        showNextMessage();
    });
    </script>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        <div class="pagination-custom">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection

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

<style>
/* General Bottom Navbar Styles */
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
    padding-bottom: 40px; /* Adjusted padding to the bottom */
}
</style>