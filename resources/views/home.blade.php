@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Hello, ') }}{{ Auth::user()->name }} {{ __('!') }} <!-- Display user's name -->
                    <br>
                    <small>{{ now()->format('l, F j, Y') }}</small> <!-- Display today's date -->
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5>What would you like to do today?</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards Section with Two Cards per Row on Mobile -->
    <div class="row row-cols-2 g-4 mt-4">
        <!-- Card 1 -->
        <div class="col">
            <div class="card">
                <img src="..." class="card-img-top" alt="Page 1">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">Skin Assessment</p>
                    <a href="{{ route('SkinProfileForm.create') }}" class="btn btn-primary">Click</a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col">
            <div class="card">
                <img src="..." class="card-img-top" alt="Page 2">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">Product</p>
                    <a href="{{ route('Product.create') }}" class="btn btn-primary">Click</a>

                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col">
            <div class="card">
                <img src="..." class="card-img-top" alt="Page 3">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">My Skin</p>
                    <a href="#" class="btn btn-primary">Click</a> <!-- Placeholder Link -->
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col">
            <div class="card">
                <img src="..." class="card-img-top" alt="Page 4">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">Insight</p>
                    <a href="#" class="btn btn-primary">Click</a> <!-- Placeholder Link -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
