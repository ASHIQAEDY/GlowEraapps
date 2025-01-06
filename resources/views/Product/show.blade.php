@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->BrandName }}</h1>
    <p><strong>Purchased Date:</strong> {{ $product->PurchasedDate }}</p>
    <p><strong>Open Date:</strong> {{ $product->OpenDate }}</p>
    <p><strong>Expiry Date:</strong> {{ $product->ExpiryDate }}</p>

    @if($product->image)
        <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image" style="max-width: 300px; max-height: 300px;">
    @else
        <p>No image available</p>
    @endif
</div>
@endsection
