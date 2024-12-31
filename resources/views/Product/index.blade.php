@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Product List</h1>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Brand Name</th>
                <th>Purchased Date</th>
                <th>Open Date</th>
                <th>Expiry Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->BrandName }}</td>
                    <td>{{ $product->PurchasedDate }}</td>
                    <td>{{ $product->OpenDate }}</td>
                    <td>{{ $product->ExpiryDate }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('Product.edit', $product->ProductID) }}" class="btn btn-primary btn-sm">Edit</a>

                        <!-- Delete Button -->
                        <form action="{{ route('Product.destroy', $product->ProductID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
