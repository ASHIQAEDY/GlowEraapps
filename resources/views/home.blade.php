@extends('layouts.app')

@section('content')
    <!-- Add your custom styles here -->
    <style>
        body {
            background-color: #4B0082 !important; /* Indigo - #4B0082 */
            color: white; /* Optional: Change text color to white for better readability */
        }

        .card {
            background-color:rgba(229, 221, 235, 0.53); /* White background for cards */
            color: black; /* Text color for cards */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.8); /* 50% opacity shadow */
            transition: box-shadow 0.3s ease-in-out; /* Smooth transition for hover effect */
        }

        .card:hover {
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.5); /* Hover effect with stronger shadow */
        }
    </style>

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
                <a href="{{ route('SkinProfileForm.create') }}" class="card-link">
                    <div class="card">
                        <img src="{{ asset('images/skinassessment.png') }}" class="card-img-top" alt="Skin Assessment Image">
                        <div class="card-body">
                            <h5 class="card-title">Skin Assessment</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 2 -->
            <div class="col">
                <a href="{{ route('Product.create') }}" class="card-link">
                    <div class="card">
                        <img src="{{ asset('images/img2.png') }}" class="card-img-top" alt="Product">
                        <div class="card-body">
                            <h5 class="card-title">Product</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 3 -->
            <div class="col">
                <a href="#" class="card-link"> <!-- Placeholder Link -->
                    <div class="card">
                        <img src="{{ asset('images/Myskin.png') }}" class="card-img-top" alt="My Skin">
                        <div class="card-body">
                            <h5 class="card-title">My Skin</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 4 -->
            <div class="col">
            <a href="{{ route('visualization')}}" class="card-link">
                    <div class="card">
                        <img src="{{ asset('images/insight.png') }}" class="card-img-top" alt="Insight">
                        <div class="card-body">
                            <h5 class="card-title">Insight</h5>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection
