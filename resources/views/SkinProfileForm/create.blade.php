@extends('layouts.app')
<!-- Add this in the <head> section of your layout file -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

@section('content')
<!-- Add custom styles to match home page background -->
<style>
    body {
        background-color:rgb(81, 13, 130);  !important; /* Indigo - same as home */
        color: white;
    }

    .card {
        background-color: rgba(229, 221, 235, 0.53); /* Same as home cards */
        color: black;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.8);
        transition: box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.5);
    }

    .btn-outline-primary {
        color: white !important; /* Force text color to white */
        border-color: white !important; /* Optional: Match border color to white */
    }
    .btn-outline-primary.active, 
    .btn-outline-primary:hover, 
    .btn-outline-primary:focus {
        background-color: rgb(206, 154, 243) !important; /* Ensure active button stays white */
        color: rgb(162, 139, 179) !important; /* Contrast text color for active buttons */
    }
    .btn-group-toggle .btn {
        border-radius: 4px;
    }
</style>
<div class="container" style="padding-bottom: 150px;"> <!-- Add more padding to the bottom -->
   
    <h4 class="text-center mb-4">Please Rate The Severity Of Your Skin Concerns</h4>
    <!-- Back to Home Button in the Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create New Skin Profile</h1>
    </div>
  
    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were errors with your submission:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('SkinProfileForm.store') }}" method="POST">
        @csrf

        <!-- Helper function for button group -->
        @php
            function renderButtonGroup($name, $selectedValue = null) {
                $buttons = '';
                for ($i = 1; $i <= 5; $i++) {
                    $isActive = $selectedValue == $i ? 'active' : '';
                    $checked = $selectedValue == $i ? 'checked' : '';
                    $buttons .= "<label class='btn btn-outline-primary $isActive'>
                                    <input type='radio' name='$name' value='$i' autocomplete='off' $checked required> $i
                                 </label>";
                }
                return $buttons;
            }
        @endphp

        <!-- Guiding Information for Rating Scale -->
        <div class="mb-4">
            <p><strong>Guidance for Rating Severity:</strong> 
                <span><strong>1:</strong> No Concern</span> | 
                <span><strong>2:</strong> Mild Concern</span> | 
                <span><strong>3:</strong> Moderate Concern</span> | 
                <span><strong>4:</strong> High Concern</span> | 
                <span><strong>5:</strong> Very High Concern</span>
            </p>
        </div>
        <!-- Form Fields -->
        @foreach ([ 
            'Acne' => 'Acne', 
            'FineLine' => 'Fine Line', 
            'Darkspots' => 'Dark Spots', 
            'Redness' => 'Redness', 
            'Dryness' => 'Dryness', 
            'Oily' => 'Oily', 
            'PoresRate' => 'Pores Rate', 
            'Irritation' => 'Irritation', 
            'Firmness' => 'Firmness', 
            'Darkcircles' => 'Dark Circles' 
        ] as $fieldName => $label)
        <div class="form-group">
            <label for="{{ $fieldName }}">{{ $label }}</label>
            <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                {!! renderButtonGroup($fieldName, old($fieldName)) !!}
            </div>
            @error($fieldName)
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        @endforeach

        <!-- Buttons Section -->
        <div class="form-group mt-4 d-flex flex-column flex-md-row justify-content-between">
            <button type="submit" class="btn btn-success mb-2 mb-md-0 text-nowrap" style="background-color: #9370DB; border-color: #9370DB;">
                <i class="fa fa-save mr-2"></i> Save Profile
            </button>

            <button type="reset" class="btn btn-warning mb-2 mb-md-0 text-nowrap" style="background-color: #FFD700; border-color: #FFD700;">
                <i class="fa fa-undo mr-2"></i> Reset 
            </button>
            @if(auth()->user()->UserLevel == 1)
            <a href="{{ route('SkinProfileForm.index') }}" class="btn btn-primary text-nowrap" style="background-color: rgb(179, 94, 184); border-color: #6a0dad;">
                <i class="fa fa-eye mr-2"></i>   Skin Profile Log
            </a>
            @endif
            @if(auth()->user()->UserLevel == 0)
            <a href="{{ route('SkinProfileForm.index') }}" class="btn btn-primary text-nowrap" style="background-color: rgb(179, 94, 184); border-color: #6a0dad;">
                <i class="fa fa-eye mr-2"></i> Skin Profile Log
            </a>
            @endif
        </div>
    </form>
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

<!-- Responsive Styles -->
<style>
    .form-group {
        margin-bottom: 1.5rem;
    }
    .btn-group-toggle .btn {
        margin-bottom: 0.5rem;
    }
    .form-control {
        max-width: 100%; /* Ensure the input fields are not too wide */
    }
    @media (max-width: 576px) {
        .form-group label {
            font-size: 14px;
        }
        .btn-group-toggle .btn {
            font-size: 12px;
        }
        .btn {
            font-size: 14px;
        }
        .form-control {
            font-size: 14px;
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

    /* Make sure the page content doesn't overlap the navbar */
    .container-fluid {
        padding-bottom: 150px; /* Add padding equal to navbar height */.container {
        padding-bottom: 150px; /* Add padding equal to navbar height */
    }
</style>
@endsection