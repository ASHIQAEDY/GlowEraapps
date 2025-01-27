@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    body {
        background-color: rgb(98, 5, 164) !important; /* Indigo */
        color: white; /* Change text color to white for better readability */
    }

    .container {
        background-color: rgb(98, 5, 164); /* Indigo background for the container */
        color: white; /* White text color */
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 900px; /* Limit the width for better readability */
        margin: auto; /* Center the container */
        padding-bottom: 100px; /* Ensure space for the navbar */
    }

    .card {
        background-color: rgb(98, 5, 164); /* Indigo background for cards */
        color: white; /* White text color for cards */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.8); /* 50% opacity shadow */
        transition: box-shadow 0.3s ease-in-out; /* Smooth transition for hover effect */
        margin: auto; /* Center the card */
    }

    .card:hover {
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.5); /* Hover effect with stronger shadow */
    }

    .card-header {
        background-color: rgb(133, 97, 159); /* Slightly lighter indigo for card header */
        color: white; /* White text color */
    }

    .card-body {
        background-color: rgb(98, 5, 164); /* Indigo background for card body */
        color: white; /* White text color */
    }

    .card-link {
        text-decoration: none;
        color: white; /* White text color for links */
    }

    .card-link:hover {
        color: #FFD700; /* Gold color for hover */
    }

    /* Bottom Navbar Styles */
    .bottom-navbar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgb(84, 63, 100); /* Indigo color */
        padding: 10px 0;
        display: flex;
        justify-content: space-around;
        align-items: center;
        box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.2);
    }

    .bottom-navbar a {
        color: white;
        text-decoration: none;
        font-size: 16px;
        text-align: center;
    }

    .bottom-navbar a:hover {
        color: #FFD700; /* Gold color for hover */
    }

    .bottom-navbar i {
        font-size: 20px;
        display: block;
        margin-bottom: 5px;
    }

    /* Make sure the page content doesn't overlap the navbar */
    .container {
        padding-bottom: 80px; /* Adjusted padding to the bottom */
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
    <div class="row row-cols-1 row-cols-sm-2 g-4 mt-4">
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
            <a href="{{ route('face-detection.index') }}" class="card-link"> <!-- Placeholder Link -->
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

<!-- Bottom Navbar -->
<div class="bottom-navbar">
    <a href="{{ route('Aboutus.index') }}">
        <i class="fas fa-info-circle"></i>
        <span>About Us</span>
    </a>
    <a href="{{ route('home') }}">
        <i class="fas fa-home"></i>
        <span>Home</span>
    </a>
    <a href="{{ route('Tips.index') }}">
        <i class="fas fa-lightbulb"></i>
        <span>Tips</span>
    </a>
</div>
@endsection