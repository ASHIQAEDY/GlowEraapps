@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

@section('content')
<div class="container">
    <a href="{{ route('home') }}" class="btn btn-secondary p-2">
        <i class="fa fa-home"></i>
    </a>

    <h1>Create New Product</h1>
    <form action="{{ route('Product.store') }}" method="POST" enctype="multipart/form-data"> <!-- Add enctype for file upload -->
        @csrf
      
        <div class="form-group">
            <label for="BrandName">Brand Name</label>
            <input type="text" name="BrandName" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="PurchasedDate">Purchased Date</label>
            <input type="date" name="PurchasedDate" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="OpenDate">Open Date</label>
            <input type="date" name="OpenDate" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="ExpiryDate">Expiry Date</label>
            <input type="date" name="ExpiryDate" class="form-control" required>
        </div>

        <!-- Image Upload Field -->
        <div class="form-group">
            <label for="image">Product Image (Optional)</label>
            <input type="file" name="image" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-success mt-3">Add Product</button>

        <a href="{{ route('Product.index') }}" class="btn btn-primary text-nowrap" style="width: auto;">
            <i class="fa fa-eye mr-2"></i> View Recent Forms
        </a>
    </form>
</div>
@endsection
