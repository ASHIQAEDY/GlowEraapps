@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Product</h1>
    <form action="{{ route('Product.store') }}" method="POST"> <!-- Correct route here -->
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
            <label for="OpenDate">Open Date </label>
            <input type="date" name="OpenDate" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ExpiryDate">Expiry Date</label>
            <input type="date" name="ExpiryDate" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Add Product</button>
    </form>
</div>
@endsection
