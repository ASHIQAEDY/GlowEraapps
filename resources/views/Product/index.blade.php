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

    .bottom-navbar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color:rgb(84, 63, 100);
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
                    <p class="card-text"><strong>User ID:</strong></p>
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
        <div class="alert alert-warning text-center">
            No products found. Please try for something else.
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('Product.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create New Product
            </a>
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
                                <a href="{{ route('Product.edit', $product->ProductID) }}" 
                                   class="btn btn-primary btn-sm" 
                                   style="background-color: rgb(87, 221, 219); border-color: #6a0dad; padding: 8px; font-size: 16px; width: 40px; height: 40px; display: flex; justify-content: center; align-items: center; border-radius: 50%;">
                                    <i class="fas fa-edit" style="color: white;"></i>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('Product.destroy', $product->ProductID) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            style="background-color: rgb(231, 3, 7); border-color: #6a0dad; padding: 8px; font-size: 16px; width: 40px; height: 40px; display: flex; justify-content: center; align-items: center; border-radius: 50%;" 
                                            onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="fas fa-trash-alt" style="color: white;"></i>
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