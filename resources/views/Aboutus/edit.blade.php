@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    /* Container Styling */
    .container {
        background-color: #6a0dad; /* Dark purple background for the container */
        border-radius: 15px;
        padding: 20px;
        color: #fff; /* White text color */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 900px; /* Limit the width for better readability */
        margin: auto; /* Center the container */
        padding-bottom: 100px; /* Ensure space for the navbar */
    }

    /* Button Styling */
    .btn-secondary, .btn-primary, .btn-success, .btn-danger {
        background-color: #4b0082; /* Dark purple button color */
        border: none;
        color: #fff; /* White text color */
    }
    .btn-secondary:hover, .btn-primary:hover, .btn-success:hover, .btn-danger:hover {
        background-color: #2e0854; /* Darker purple on hover */
    }
    .btn-success {
        background-color: #28a745; /* Green button color */
    }
    .btn-success:hover {
        background-color: #218838; /* Darker green on hover */
    }
    .btn {
        border-radius: 10px;
    }

    /* Form Styling */
    .form-group label {
        font-weight: bold;
    }
    .form-control {
        border-radius: 10px;
        border: 1px solid #dcdcdc;
        margin-bottom: 15px; /* Add space between form controls */
        background-color:rgb(130, 0, 59); /* Dark purple background for form controls */
        color: #fff; /* White text color */
    }
    .form-control::placeholder {
        color: #dcdcdc; /* Light grey placeholder text */
    }

    /* Card Styling */
    .card {
        background-color: rgba(196, 163, 184, 0.73);
        color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #4b0082;
        color: #fff;
        border-bottom: none;
        border-radius: 10px 10px 0 0;
    }
    .card-body {
        padding: 20px;
    }

    /* Alert Styling */
    .alert-success {
        background-color: #28a745;
        color: #fff;
        border-radius: 10px;
        border: none;
    }

    /* Heading Styling */
    h1 {
        text-align: center; /* Center the heading */
        margin-bottom: 30px; /* Add space below the heading */
    }

    /* Centering Buttons */
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
</style>

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header text-white text-center" style="background-color: #6a0dad;">
            <h2>Edit About Us</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('Aboutus.update', $aboutUs->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="introduction">Introduction</label>
                    <textarea name="introduction" id="introduction" class="form-control" rows="5">{{ $aboutUs->introduction }}</textarea>
                </div>

                <div class="form-group">
                    <label for="services">Services</label>
                    <textarea name="services" id="services" class="form-control" rows="5">{{ $aboutUs->services }}</textarea>
                </div>

                <div class="form-group">
                    <label for="team_background">Team Background</label>
                    <textarea name="team_background" id="team_background" class="form-control" rows="5">{{ $aboutUs->team_background }}</textarea>
                </div>

                <div class="form-group">
                    <label for="impact">Impact</label>
                    <textarea name="impact" id="impact" class="form-control" rows="5">{{ $aboutUs->impact }}</textarea>
                </div>

                <div class="form-group">
                    <label for="contact">Contact</label>
                    <textarea name="contact" id="contact" class="form-control" rows="5">{{ $aboutUs->contact }}</textarea>
                </div>

                <div class="form-group">
                    <label for="version">Version</label>
                    <input type="text" name="version" id="version" class="form-control" value="{{ $aboutUs->version }}">
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Update About Us</button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-4 text-center">
        <a href="{{ route('Aboutus.index') }}" class="btn btn-secondary">Back to About Us</a>
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