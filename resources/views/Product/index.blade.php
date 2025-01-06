@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

@section('content')
<div class="container">
    <!-- Navigation Back to Home -->
    <a href="{{ route('home') }}" class="btn btn-secondary mb-3">
        <i class="fa fa-home"></i> Back to Home
    </a>

    <h1 class="mb-4">Product List</h1>

    @if(session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif

    <!-- Mobile View Table Conversion -->
    <div class="row">
        @foreach($products as $product)
            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <!-- Card for each product -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->BrandName }}</h5>
                        <p class="card-text"><strong>Purchased Date:</strong> {{ $product->PurchasedDate }}</p>
                        <p class="card-text"><strong>Open Date:</strong> {{ $product->OpenDate }}</p>
                        <p class="card-text"><strong>Expiry Date:</strong> {{ $product->ExpiryDate }}</p>

                        <!-- Image Display -->
                        <div class="mb-2">
                            @if($product->image)
                                <img src="{{ Storage::url('images/' . $product->image) }}" alt="Product Image" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </div>

                        <!-- Actions: Edit & Delete -->
                        <div class="d-flex justify-content-between">
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

    <!-- Pagination Links -->
<div class="d-flex justify-content-center mt-4">
    <div class="pagination-custom">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection
