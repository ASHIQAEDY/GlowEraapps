@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    .container {
        background-color: rgb(121, 56, 173); /* Dark purple background for the container */
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 100%; /* Full width for better readability on mobile */
        margin: auto; /* Center the container */
    }
    .btn-secondary, .btn-primary, .btn-success {
        background-color: #4b0082; /* Dark purple button color */
        border: none;
        color: #fff; /* White text color */
    }
    .btn-secondary:hover, .btn-primary:hover, .btn-success:hover {
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
    .btn {
        border-radius: 10px;
    }
    h1 {
        text-align: center; /* Center the heading */
        margin-bottom: 30px; /* Add space below the heading */
    }
    /* Card Styling */
    .card {
        background-color: #f8f8ff; /* Ghost white background for the card */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card-body {
        padding: 15px;
    }
    .card-title {
        color: #4b0082; /* Dark purple text color */
    }
    .card-text {
        color: #4b0082; /* Dark purple text color */
    }
    /* Image Styling */
    .card img {
        border-radius: 10px;
        max-width: 100%; /* Ensure image fits within the card */
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
    /* List View */
    .list-view .product-item {
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    .list-view .product-item .card {
        display: flex;
        flex-direction: row;
        align-items: center;
        width: 100%;
    }
    .list-view .product-item .card img {
        width: 100px;
        height: 100px;
        margin-right: 15px;
    }
    .list-view .product-item .card-body {
        display: flex;
        flex-direction: column;
    }
    .alert.alert-info {
        background-color: #f3e5f5; /* Light purple background */
        border-color: #ce93d8; /* Purple border */
        color: #6a1b9a; /* Dark purple text */
    }

    .list-group-item {
        background-color: #e1bee7; /* Light purple background for list items */
        border-color: #ba68c8; /* Purple border for list items */
        color: #4a148c; /* Dark purple text for list items */
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
</style>

@section('content')
<div class="container">
    <!-- Navigation Back to Home -->
    <a href="{{ route('home') }}" class="btn btn-secondary mb-3">
        <i class="fa fa-home"></i> Back to Home
    </a>

    <h1 class="mb-4" style="color: white;"> Product </h1>

    @if(session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif

    <!-- Display Notifications -->
    @if(Auth::user()->notifications->count() > 0)
        <div class="alert alert-info mb-4">
            <h4>Notifications</h4>
            <ul class="list-group">
                @foreach(Auth::user()->notifications as $notification)
                    <li class="list-group-item">
                        {{ $notification->data['brand_name'] }} is about to expire on {{ $notification->data['expiry_date'] }}.
                        <a href="{{ route('Product.show', $notification->data['product_id']) }}" class="btn btn-primary btn-sm">View Product</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Mobile View Table Conversion -->
    <div class="row" id="productContainer">
        @foreach($products as $product)
            <div class="col-12 col-sm-6 col-md-4 mb-3 product-item">
                <!-- Card for each product -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Product Name: </strong>{{ $product->BrandName }}</h5>
                        <!-- Show ProductID for UserLevel 0 -->
                        @if(Auth::user()->UserLevel == 0)
                            <p class="card-text"><strong>Product ID:</strong> {{ $product->ProductID }}</p>
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
                        <div class="d-flex justify-content-center">
                            <!-- Edit Button -->
                            <a href="{{ route('Product.edit', $product->ProductID) }}" class="btn btn-primary btn-sm mx-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('Product.destroy', $product->ProductID) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mx-2" onclick="return confirm('Are you sure you want to delete this product?')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

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
