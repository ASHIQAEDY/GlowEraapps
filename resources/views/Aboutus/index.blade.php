@extends('layouts.app')
<!-- Add these lines in your layout file (e.g., layouts/app.blade.php) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@section('content')
<div class="container py-5">
    
    <div class="card shadow-lg border-0">
        <div class="card-header text-white text-center">
            <h2>About Us</h2>
        </div>
        <div class="card-body text-center">
            <div id="aboutUsCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <h3>Introduction</h3>
                        <p>{{ $aboutUs->introduction ?? 'No introduction available.' }}</p>
                    </div>
                    <div class="carousel-item">
                        <h3>Services</h3>
                        <p>{{ $aboutUs->services ?? 'No services available.' }}</p>
                    </div>
                    <div class="carousel-item">
                        <h3>Team Background</h3>
                        <p>{{ $aboutUs->team_background ?? 'No team background available.' }}</p>
                    </div>
                    <div class="carousel-item">
                        <h3>Impact</h3>
                        <p>{{ $aboutUs->impact ?? 'No impact information available.' }}</p>
                    </div>
                    <div class="carousel-item">
                        <h3>Contact</h3>
                        <p>{{ $aboutUs->contact ?? 'No contact information available.' }}</p>
                    </div>
                    <div class="carousel-item">
                        <h3>Visual</h3>
                        <p>
                            @if($aboutUs->visual)
                                <img src="{{ asset('storage/' . $aboutUs->visual) }}" alt="Visual" class="img-fluid">
                            @else
                                No visual available.
                            @endif
                        </p>
                    </div>
                    <div class="carousel-item">
                        <h3>Version</h3>
                        <p>{{ $aboutUs->version ?? 'No version information available.' }}</p>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#aboutUsCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#aboutUsCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <!-- Check UserLevel for Edit and Create Buttons -->
            @if($user && $user->UserLevel == 0)
            <div class="mt-4 text-center">
                <!-- Pass the Aboutus model instance or its ID -->
                <a href="{{ route('Aboutus.edit', $aboutUs->id) }}" class="btn btn-primary">Edit About Us</a>
                <a href="{{ route('Aboutus.create') }}" class="btn btn-success ml-2">Create New About Us</a>
            </div>
            @endif
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

<!-- Include the CSS and JavaScript -->
<style>
    body {
        background-color:rgb(184, 146, 212); /* Dark purple background */
        color: white; /* White text for better contrast */
        font-family: 'Arial', sans-serif; /* Formal font */
    }

    .card {
        background-color:rgb(195, 183, 204); /* Slightly lighter purple for the card */
    }

    .card-header {
        background-color:rgb(165, 85, 223); /* Dark purple for the header */
    }

    .btn-primary {
        background-color:rgb(137, 68, 139); /* Bright purple for buttons */
        border-color: #8a2be2;
    }

    .btn-primary:hover {
        background-color: #7a1fa2; /* Darker shade on hover */
        border-color: #7a1fa2;
    }

    .btn-success {
        background-color: #28a745; /* Green for create button */
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838; /* Darker green on hover */
        border-color: #1e7e34;
    }

    .carousel-item h3, .carousel-item p {
        text-align: center; /* Center text */
        margin: 0 auto; /* Center block elements */
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
        padding-bottom: 10px; /* Add padding equal to navbar height */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButton = document.querySelector('.btn-primary');
        if (editButton) {
            editButton.addEventListener('click', function() {
                alert('You are about to edit the About Us page!');
            });
        }
    });
</script>
@endsection