@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    .container {
        background-color: rgb(121, 56, 173); /* Dark purple background for the container */
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 600px; /* Limit the width for better readability */
        margin: auto; /* Center the container */
    }
    .btn-secondary, .btn-primary, .btn-success, .btn-warning, .btn-danger {
        background-color: #4b0082; /* Dark purple button color */
        border: none;
        color: #fff; /* White text color */
    }
    .btn-secondary:hover, .btn-primary:hover, .btn-success:hover, .btn-warning:hover, .btn-danger:hover {
        background-color: #2e0854; /* Darker purple on hover */
    }
    .form-group label {
        font-weight: bold;
    }
    .form-control {
        border-radius: 10px;
        border: 1px solid #dcdcdc;
        margin-bottom: 15px; /* Add space between form controls */
        background-color: #4b0082; /* Dark purple background for form controls */
        color: #fff; /* White text color */
    }
    .form-control::placeholder {
        color: #dcdcdc; /* Light grey placeholder text */
    }
    .btn {
        border-radius: 10px;
    }
    h1 {
        text-align: center; /* Center the heading */
        margin-bottom: 30px; /* Add space below the heading */
    }
    /* Calendar Styling */
    input[type="date"] {
        position: relative;
        padding: 10px;
        border-radius: 10px;
        border: 1px solid rgb(148, 64, 64);
        background-color: rgb(156, 110, 189); /* Dark purple background */
        color: #fff; /* White text color */
    }
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1); /* Invert colors for better visibility */
    }
    /* Centering buttons */
    .button-group {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px; /* Space between buttons */
    }
    @media (min-width: 576px) {
        .button-group {
            flex-direction: row;
        }
    }
    /* Pop-up message styling */
    .popup {
        position: fixed;
        bottom: -100px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #4b0082;
        color: #fff;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: bottom 0.5s;
        z-index: 1000;
        animation: slideIn 0.5s forwards; /* Add animation */
    }
    .popup.show {
        bottom: 20px;
    }
    .popup .close-btn {
        background: none;
        border: none;
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        position: absolute;
        top: 5px;
        right: 10px;
    }
    /* Define the slide-in animation */
    @keyframes slideIn {
        from {
            bottom: -100px;
            opacity: 0;
        }
        to {
            bottom: 20px;
            opacity: 1;
        }
    }
    /* Define the slide-out animation */
    @keyframes slideOut {
        from {
            bottom: 20px;
            opacity: 1;
        }
        to {
            bottom: -100px;
            opacity: 0;
        }
    }
    .popup.slide-out {
        animation: slideOut 0.5s forwards;
    }
    /* General Bottom Navbar Styles */
    .bottom-navbar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgb(84, 63, 100); /* Indigo color */
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 10px 0;
        box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }

    .bottom-navbar a {
        display: flex;
        flex-direction: column; /* Align icons above text */
        justify-content: center;
        align-items: center;
        color: white;
        text-decoration: none;
        font-size: 14px;
        padding: 5px;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .bottom-navbar a:hover {
        color: #FFD700; /* Gold color for hover */
        transform: scale(1.1); /* Slightly enlarge on hover */
    }

    .bottom-navbar i {
        font-size: 20px; /* Icon size */
        margin-bottom: 4px; /* Space between icon and text */
    }

    .bottom-navbar span {
        font-size: 12px; /* Text size below the icons */
    }

    /* Make sure the page content doesn't overlap the navbar */
    .container {
        padding-bottom: 80px; /* Adjusted padding to the bottom */
    }
</style>

@section('content')
<div class="container py-5">
    <!-- Card for Tip Details -->
    <div class="card shadow-lg border-0">
        <div class="card-header text-white text-center" style="background-color: #6a0dad;">
            <h2 class="mb-0">{{ $tip->title ?? 'No Title Available' }}</h2>
        </div>
        <div class="card-body">
            <p class="card-text text-muted mb-4">
                <i class="fas fa-tag"></i> <strong>Category:</strong> {{ $tip->category }}
            </p>

            <div class="tip-description" style="font-size: 1.2rem; line-height: 1.8; color: #333;">
                <strong>Description:</strong>
                <p style="font-style: italic; color: #6a0dad;">Discover the secret to glowing skin and healthy living!</p>
                <p>{!! nl2br(e($tip->description)) !!}</p>
            </div>
            
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <a href="{{ route('Tips.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Tips
            </a>
           
            @if(Auth::user()->UserLevel == 0)
            <a href="{{ route('Tips.edit', $tip->id) }}" class="btn btn-secondary"><i class="fa fa-edit"></i> Edit</a>
            @endif
        </div>
    </div>

    <!-- Additional Section: Fun Fact -->
    <div class="mt-5 p-4 bg-light rounded shadow" style="margin-bottom: 100px;">
        <h4 class="text-center text-secondary"><i class="fas fa-lightbulb"></i> Fun Fact About Skin Health</h4>
        <p class="text-center mt-3" style="font-size: 1.1rem;">
            Did you know? Your skin renews itself approximately every 28 days. Taking care of it daily can work wonders!
        </p>
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