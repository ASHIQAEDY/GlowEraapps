@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    /* Container Styling */
    .container {
        background-color: rgb(121, 56, 173); /* Dark purple background for the container */
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 900px; /* Limit the width for better readability */
        margin: auto; /* Center the container */
    }
    .btn-secondary, .btn-primary, .btn-success {
        background-color: #4b0082; /* Dark purple button color */
        border: none;
        color: #fff; /* White text color */
    }
    .btn-secondary:hover, .btn-primary:hover, .btn-success:hover {
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

    /* Tip Card Styling */
    .tip-card {
        background-color: #6a0dad;
        color: #fff;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .tip-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    /* Active (Tap/Click) Effect for Mobile */
    @media (max-width: 767px) {
        .tip-card:active {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
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
</style>

@section('content')
<div class="container">
<div class="mt-3">
                <a href="{{ route('home') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Home</a>
            </div>

            
    <h1>Skin Health Tips</h1>
    <!-- Conditionally show the "Create New Tip" button only if the user has UserLevel = 0 -->
    @if(Auth::user()->UserLevel == 0)
        <div class="button-group mt-3">
            <a href="{{ route('Tips.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Create New Tip</a>
        </div>
    @endif

    <!-- Check if there are any success messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Show all the tips -->
    <ul>
        
        @foreach($tips as $tip)
            <li>
                
                <!-- Tip Card -->
                <div class="tip-card">
                    <h3>{{ $tip->title }}</h3>
                    
                    <small>Category: {{ $tip->category }}</small>

                    <div class="button-group">
    <!-- View Button -->
    <a href="{{ route('Tips.show', $tip->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i> View</a>

    <!-- Conditionally show the "Edit" button only if the user has UserLevel = 0 -->
    @if(Auth::user()->UserLevel == 0)
      

        <!-- Delete Button -->
        <form action="{{ route('Tips.destroy', $tip->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tip?')" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
        </form>
    @endif
</div>
                </div>
            </li>
        @endforeach
    </ul>

    
</div>
@endsection
