@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@section('content')
<div class="container-fluid" style="background-color:rgb(91, 65, 110); color: white;"> <!-- Purple background and white text -->
    <!-- Button to go back to Home -->
    

    <h1 class="text-center mb-4">SKIN PROFILE ASSESMENTS</h1>
    @if(auth()->user()->UserLevel == 1)
    <h2 class="text-center mb-4"> YOUR MOST RECENT SKIN PROFILE:</h2>
    
    @endif
    @if(auth()->user()->UserLevel == 0)
  <h2  class="text-center mb-4">GLOWERA USER SKIN PROFILE:</h2>
  @endif
    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Displaying existing skin profiles -->
    @foreach($forms as $profile)
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover shadow" style="background-color: #f8f9fa; border: 2px solid #6a0dad; border-radius: 15px;"> <!-- Light background with purple border and curved corners -->
            <thead style="background-color: #6a0dad; color: white;"> <!-- Purple header -->
                <tr>
                    <th>Date</th>
                    <th>Total Score</th>
                    <th>Concern Level</th>
                    @if(Auth::user()->UserLevel == 0)
                        <th>User ID</th>
                    @endif
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $profile->created_at->format('d-m-Y') }}</td>
                    <td>{{ $profile->TotalScore }}</td>
                    <td>
                        @if($profile->InterpretationStatus == 'Excellent Skin Health')
                            Excellent
                        @elseif($profile->InterpretationStatus == 'Good Skin Health')
                            Good
                        @elseif($profile->InterpretationStatus == 'Moderate Skin Health')
                            Moderate
                        @elseif($profile->InterpretationStatus == 'Poor Skin Health')
                            Poor
                        @elseif($profile->InterpretationStatus == 'Very Poor Skin Health')
                            Very Poor
                        @else
                            Not Available
                        @endif
                    </td>
                    @if(Auth::user()->UserLevel == 0)
                        <td>{{ $profile->user_id }}</td>
                    @endif
                    <td>
                        <a href="{{ route('SkinProfileForm.show', $profile->FormID) }}" class="btn btn-info btn-sm m-1" style="background-color: #6a0dad; border-color: #6a0dad;">
                            <i class="fas fa-eye"></i> View
                        </a>
                        @if(auth()->user()->UserLevel == 0)
                        <a href="{{ route('SkinProfileForm.edit', $profile->FormID) }}" class="btn btn-warning btn-sm m-1" style="background-color: #9370DB; border-color: #9370DB;">
                            <i class="fas fa-pencil-alt"></i> Edit
                        </a>
                        @endif
                        <form action="{{ route('SkinProfileForm.destroy', $profile->FormID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm m-1" style="background-color: #8B008B; border-color: #8B008B;" onclick="return confirmDelete('{{ $profile->created_at->format('d-m-Y') }}')">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @endforeach

    <!-- Score Interpretation Information -->
    <div class="text-center mb-4">
        <h4>Score Interpretation:</h4>
        <p><strong>Based on the total score, the user's skin health is interpreted as follows:</strong></p>
        <table class="table table-bordered table-hover shadow" style="background-color:rgb(132, 124, 175); border: 2px solid #6a0dad; border-radius: 15px;">
            <thead style="background-color:rgb(255, 255, 255); color: white;">
                <tr>
                    <th>Score Range</th>
                    <th>Skin Health Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>10-14</strong></td>
                    <td>Excellent Skin Health</td>
                </tr>
                <tr>
                    <td><strong>15-24</strong></td>
                    <td>Good Skin Health</td>
                </tr>
                <tr>
                    <td><strong>25-34</strong></td>
                    <td>Moderate Skin Health</td>
                </tr>
                <tr>
                    <td><strong>35-44</strong></td>
                    <td>Poor Skin Health</td>
                </tr>
                <tr>
                    <td><strong>45-50</strong></td>
                    <td>Very Poor Skin Health</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Interactive Information Section -->
    <div class="text-center mb-4">
        <h4>Information:</h4>
        <div class="slider">
            <div class="slides">
                <div class="slide" id="interactive-info"></div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('SkinProfileForm.create') }}" class="btn btn-primary btn-lg" style="background-color: #6a0dad; border-color: #6a0dad; border-radius: 10px;">
            <i class="fa fa-arrow-left mr-2"></i> Back to Skin Assessment
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
        background-color:rgb(70, 102, 134); /* Light grey on hover */
    }
    .table thead th {
        background-color:rgb(171, 139, 192); /* Purple background for header */
        color: white;
        border: none;
    }
    .table tbody td {
        background-color:rgb(171, 139, 192); /* White background for rows */
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
            padding-right: 15
        }
    }

    /* Slider Styles */
    .slider {
        position: relative;
        width: 100%;
        height: 50px;
        overflow: hidden;
        border: 1px solid #6a0dad;
        border-radius: 10px;
        background-color: #f8f9fa;
    }
    .slides {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }
    .slide {
        min-width: 100%;
        box-sizing: border-box;
        padding: 11px;
        text-align: center;
        color: #6a0dad;
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
        padding-bottom: 60px; /* Add padding equal to navbar height */
    }
</style>

<script>
    function confirmDelete(formDate) {
        var confirmationMessage = 'Are you sure you want to delete this profile? (Form Date: ' + formDate + ')';
        return confirm(confirmationMessage);
    }

    // Interactive Information Rotation
    const infoMessages = [
        "Tip 1: Drink plenty of water.",
        "Tip 2: Use sunscreen daily to protect your skin from UV damage.",
        "Tip 3: Incorporate a balanced diet rich in vitamins and minerals.",
        "Tip 4: Get enough sleep to allow your skin to repair and rejuvenate.",
        "Tip 5: Avoid smoking and excessive alcohol consumption.",
        "Tip 6: Use gentle skincare products suitable for your skin type.",
        "Tip 7: Exercise regularly to improve blood circulation and skin health.",
        "Tip 8: Cleanse your skin twice daily to remove dirt and impurities.",
        "Tip 9: Avoid touching your face frequently to prevent the spread of bacteria.",
        "Tip 10: Use a moisturizer suitable for your skin type to keep your skin hydrated.",
        "Tip 11: Exfoliate your skin once or twice a week to remove dead skin cells.",
        "Tip 12: Manage stress through relaxation techniques like yoga or meditation.",
        "Tip 13: Avoid using harsh chemicals on your skin.",
        "Tip 14: Protect your skin from extreme weather conditions.",
        "Tip 15: Regularly check your skin for any unusual changes or growths."
    ];

    let currentIndex = 0;

    function rotateInfo() {
        document.getElementById('interactive-info').innerText = infoMessages[currentIndex];
        currentIndex = (currentIndex + 1) % infoMessages.length;
    }

    document.addEventListener('DOMContentLoaded', () => {
        rotateInfo();
        setInterval(rotateInfo, 5 * 1000); // Change every 5 seconds
    });
</script>
@endsection