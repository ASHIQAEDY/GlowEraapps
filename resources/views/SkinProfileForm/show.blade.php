@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@section('content')
<div class="container">
@if(auth()->user()->UserLevel == 1)
    <h1>Your Skin Profile</h1>
@endif
@if(auth()->user()->UserLevel == 0)
  <h1>User Skin Profile</h1>
@endif
    <!-- Displaying success or error message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Table 1: Total Score and Concern Level -->
    <table class="table table-bordered mb-4">
        <tr>
        @if(auth()->user()->UserLevel == 0)
            <th>User Total Score:</th>
            @endif
            @if(auth()->user()->UserLevel == 1)
            <th>Your Total Score:</th>
            @endif
            <td>{{ $profile->TotalScore }}</td>
        </tr>
        <tr>
            <th>Concern Level:</th>
            <td id="concern-level">
                @if($profile->InterpretationStatus == 'Excellent Skin Health')
                    Excellent Skin Health
                @elseif($profile->InterpretationStatus == 'Good Skin Health')
                    Good Skin Health
                @elseif($profile->InterpretationStatus == 'Moderate Skin Health')
                    Moderate Skin Health
                @elseif($profile->InterpretationStatus == 'Poor Skin Health')
                    Poor Skin Health
                @elseif($profile->InterpretationStatus == 'Very Poor Skin Health')
                    Very Poor Skin Health
                @else
                    Not Available
                @endif
            </td>
        </tr>
        <tr>
        @if(auth()->user()->UserLevel == 1)
            <th>Advice:</th>
            @endif
            @if(auth()->user()->UserLevel == 0)
            <th>Advice the user to :</th>
            @endif
            <td id="advice"></td>
        </tr>
    </table>

    <!-- Table 2: Detailed Skin Concerns -->
    <table class="table table-bordered mb-4">
        <tr>
            <th>Acne</th>
            <td>{{ $profile->Acne }}</td>
        </tr>
        <tr>
            <th>Fine Line</th>
            <td>{{ $profile->FineLine }}</td>
        </tr>
        <tr>
            <th>Dark Spots</th>
            <td>{{ $profile->Darkspots }}</td>
        </tr>
        <tr>
            <th>Redness</th>
            <td>{{ $profile->Redness }}</td>
        </tr>
        <tr>
            <th>Dryness</th>
            <td>{{ $profile->Dryness }}</td>
        </tr>
        <tr>
            <th>Oily</th>
            <td>{{ $profile->Oily }}</td>
        </tr>
        <tr>
            <th>Pores Rate</th>
            <td>{{ $profile->PoresRate }}</td>
        </tr>
        <tr>
            <th>Irritation</th>
            <td>{{ $profile->Irritation }}</td>
        </tr>
        <tr>
            <th>Firmness</th>
            <td>{{ $profile->Firmness }}</td>
        </tr>
        <tr>
            <th>Dark Circles</th>
            <td>{{ $profile->Darkcircles }}</td>
        </tr>
    </table>

    <!-- Table 3: Actions -->
    @if(auth()->user()->UserLevel == 0)
    <div class="mb-4">
        <a href="{{ route('SkinProfileForm.edit', $profile->FormID) }}" class="btn btn-warning">
            <i class="fa fa-edit mr-2"></i> Edit User Message
        </a>
        @endif
        @if(auth()->user()->UserLevel == 1)
        <a href="{{ route('SkinProfileForm.edit', $profile->FormID) }}" class="btn btn-warning btn-sm m-1">
            <i class="fas fa-pencil-alt"></i> Edit your skin Profile
        </a>
        @endif
        <a href="{{ route('SkinProfileForm.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-2"></i> Back to List
        </a>
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

<!-- Responsive Styles -->
<style>
    body {
        background-color: #E6E6FA; /* Light purple background */
    }
    .table {
        border-collapse: separate;
        border-spacing: 0 10px; /* Add space between rows */
        border: 2px solid #6a0dad; /* Add border to table */
        border-radius: 15px; /* Curved borders for outer table */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow to table */
    }
    .table th, .table td {
        vertical-align: middle;
        text-align: center;
    }
    .table-hover tbody tr:hover {
        background-color: rgb(70, 102, 134); /* Light grey on hover */
    }
    .table thead th {
        background-color: rgb(171, 139, 192); /* Purple background for header */
        color: white;
        border: none;
    }
    .table tbody td {
        background-color: rgb(171, 139, 192); /* White background for rows */
        border: none;
    }
    .btn {
        border-radius: 20px; /* Rounded buttons */
    }
    .btn-info {
        background-color: #6a0dad;
        border-color: #6a0dad;
    }
    .btn-warning {
        background-color: #9370DB;
        border-color: #9370DB;
    }
    .btn-danger {
        background-color: #8B008B;
        border-color: #8B008B;
    }
    .btn-info:hover, .btn-warning:hover, .btn-danger:hover {
        opacity: 0.8; /* Slight transparency on hover */
    }
    @media (max-width: 768px) {
        .table-responsive {
            padding-left: 10px;
            padding-right: 10px;
            overflow-x: auto; /* Make table scrollable horizontally */
        }
        .btn {
            font-size: 14px; /* Adjust button font size for smaller screens */
        }
        .table th, .table td {
            font-size: 12px; /* Adjust table text for smaller screens */
        }
    }

    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
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
    .container {
        padding-bottom: 10px; /* Add padding equal to navbar height */
    }
</style>

<script>
    function confirmDelete(formDate) {
        var confirmationMessage = 'Are you sure you want to delete this profile? (Form Date: ' + formDate + ')';
        return confirm(confirmationMessage);
    }

    // Advice Rotation Based on Concern Level
    const adviceMessages = @json(config('advice'));
    const concernLevel = document.getElementById('concern-level').innerText.trim();
    console.log('Concern Level:', concernLevel); // Debugging statement
    const messages = adviceMessages[concernLevel] || ["No advice available."];
    console.log('Advice Messages:', messages); // Debugging statement
    let currentIndex = 0;

    function updateAdvice() {
        document.getElementById('advice').innerText = messages[currentIndex];
        console.log('Current Advice:', messages[currentIndex]); // Debugging statement
        currentIndex = (currentIndex + 1) % messages.length;
    }
    document.addEventListener('DOMContentLoaded', () => {
        updateAdvice();
        setInterval(updateAdvice, 5 * 1000); // Change every 5 seconds
    });
</script>
@endsection