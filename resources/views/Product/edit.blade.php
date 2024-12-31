@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Product</h1>
    <form action="{{ route('Product.update', $product->ProductID) }}" method="POST">
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
        <button type="submit" class="btn btn-warning mt-3">Update Product</button>
    </form>
</div>
@endsection
