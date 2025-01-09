@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->BrandName }}</h1>
    <p><strong>Product ID:</strong> {{ $product->ProductID }}</p>
    <p><strong>Purchased Date:</strong> {{ $product->PurchasedDate }}</p>
    <p><strong>Open Date:</strong> {{ $product->OpenDate }}</p>
    <p><strong>Expiry Date:</strong> {{ $product->ExpiryDate }}</p>
    @if($product->image)
                        <p class="card-text"><strong>Image:</strong>
                            <img src="{{$product->image}}" style="width:70px;height:70px;">
                        </p>
                    @endif
    <a href="{{ route('home') }}" class="btn btn-secondary">Back to Home</a>
</div>
@endsection