@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Product</h1>
    <form action="{{ route('Product.update', $product->ProductID) }}" method="POST" enctype="multipart/form-data"> <!-- Add enctype for file upload -->
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="BrandName">Brand Name</label>
            <input type="text" name="BrandName" class="form-control" value="{{ old('BrandName', $product->BrandName) }}" required>
        </div>

        <div class="form-group">
            <label for="PurchasedDate">Purchased Date</label>
            <input type="date" name="PurchasedDate" class="form-control" value="{{ old('PurchasedDate', $product->PurchasedDate) }}" required>
        </div>

        <div class="form-group">
            <label for="OpenDate">Open Date</label>
            <input type="date" name="OpenDate" class="form-control" value="{{ old('OpenDate', $product->OpenDate) }}" required>
        </div>

        <div class="form-group">
            <label for="ExpiryDate">Expiry Date</label>
            <input type="date" name="ExpiryDate" class="form-control" value="{{ old('ExpiryDate', $product->ExpiryDate) }}" required>
        </div>

        <!-- Image Upload Field -->
        <div class="form-group">
            <label for="image">Product Image (Optional)</label>
            <input type="file" name="image" class="form-control">
            <!-- Show the current image if available -->
            @if($product->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image" width="100">
                    <p class="mt-2">Current Image</p>
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-warning mt-3">Update Product</button>

        <!-- Cancel button -->
        <a href="{{ route('Product.index') }}" class="btn btn-danger mt-3">
            <i class="fa fa-times-circle mr-2"></i> Cancel
        </a>
    </form>
</div>
@endsection
