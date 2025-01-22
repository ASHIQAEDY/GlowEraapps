@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header text-white text-center" style="background-color: #4b0082;">
            <h2>Create About Us</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('Aboutus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="introduction">Introduction</label>
                    <textarea name="introduction" id="introduction" class="form-control" rows="4" required></textarea>
                    <small class="form-text text-muted">Max 200 words</small>
                </div>

                <div class="form-group">
                    <label for="services">Services</label>
                    <textarea name="services" id="services" class="form-control" rows="4" required></textarea>
                    <small class="form-text text-muted">Max 200 words</small>
                </div>

                <div class="form-group">
                    <label for="team_background">Team Background</label>
                    <textarea name="team_background" id="team_background" class="form-control" rows="4" required></textarea>
                    <small class="form-text text-muted">Max 200 words</small>
                </div>

                <div class="form-group">
                    <label for="impact">Impact</label>
                    <textarea name="impact" id="impact" class="form-control" rows="4" required></textarea>
                    <small class="form-text text-muted">Max 200 words</small>
                </div>

                <div class="form-group">
                    <label for="contact">Contact</label>
                    <textarea name="contact" id="contact" class="form-control" rows="4" required></textarea>
                    <small class="form-text text-muted">Max 200 words</small>
                </div>

                <div class="form-group">
                    <label for="visual">Visual (Image)</label>
                    <input type="file" name="visual" id="visual" class="form-control-file">
                    @error('visual')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="version">Version</label>
                    <input type="text" name="version" id="version" class="form-control">
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Create About Us</button>
                    <a href="{{ route('Aboutus.index') }}" class="btn btn-danger text-nowrap" style="width: auto;">
                        <i class="fa fa-times mr-2"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        font-family: 'Arial', sans-serif; /* Formal font */
    }
    .container {
        background-color: #4b0082; /* Deep purple background for the container */
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 100%; /* Ensure the container is responsive */
        margin: auto; /* Center the container */
    }
    .card {
        max-width: 100%; /* Ensure the card is responsive */
    }
    .btn-secondary, .btn-primary, .btn-success, .btn-danger {
        background-color: #4b0082; /* Deep purple button color */
        border: none;
        color: #fff; /* White text color */
    }
    .btn-secondary:hover, .btn-primary:hover, .btn-success:hover, .btn-danger:hover {
        background-color: #9370DB; /* Light purple on hover */
    }
    .form-group label {
        font-weight: bold;
    }
    .form-control {
        border-radius: 10px;
        border: 1px solid #dcdcdc;
        margin-bottom: 15px; /* Add space between form controls */
        background-color: #4b0082; /* Deep purple background for form controls */
        color: #fff; /* White text color */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add box shadow */
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
    /* Hover style for form controls */
    .form-control:hover {
        background-color:rgb(86, 44, 170); /* Light purple on hover */
    }
</style>
@endpush

@push('scripts')
<script>
    // Show the pop-up message after a delay
    window.onload = function() {
        setTimeout(function() {
            document.getElementById('popup').classList.add('show');
        }, 1000); // Show after 1 second
    };

    // Close the pop-up message
    function closePopup() {
        var popup = document.getElementById('popup');
        popup.classList.remove('show');
        popup.classList.add('slide-out');
        setTimeout(function() {
            popup.style.display = 'none';
        }, 500); // Match the duration of the slide-out animation
    }
</script>
@endpush