@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@section('content')
<div class="container-fluid">
    <h1 class="text-center mb-4">SKIN PROFILE</h1>
    @if(auth()->user()->UserLevel == 1)
    <h2 class="text-center mb-4"> YOUR RECENT SKIN PROFILE:</h2>
    @endif
    @if(auth()->user()->UserLevel == 0)
    <h2 class="text-center mb-4">GLOWERA USER SKIN PROFILE:</h2>
    @endif

    <!-- Search Bar -->
    <form method="GET" action="{{ route('SkinProfileForm.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by Date, Total Score, Concern Level{{ auth()->user()->UserLevel == 0 ? ', User ID' : '' }}" value="{{ request()->query('search') }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>
    </form>

    <!-- Display Success Message -->
    @if(session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
    @endif

    <!-- Displaying existing skin profiles -->
    @if($forms->isEmpty())
    <div class="alert alert-warning text-center">
        No skin profiles found matching your search criteria.
    </div>
    @else
    <div class="row">
        @foreach($forms as $profile)
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="card-title mb-0">Skin Profile Assessment</h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><i class="fas fa-calendar-day"></i> <strong>Date:</strong> {{ $profile->created_at->format('d-m-Y') }}</p>
                    <p class="card-text"><i class="fas fa-star"></i> <strong>Total Score:</strong> {{ $profile->TotalScore }}</p>
                    <p class="card-text"><i class="fas fa-heart"></i> <strong>Concern Level:</strong> {{ $profile->ConcernLevel }}</p>
                    <p class="card-text">
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
                    </p>
                    @if(Auth::user()->UserLevel == 0)
                    <p class="card-text"><strong><i class="fas fa-user"></i> User ID:</strong> {{ $profile->user_id }}</p>
                    @endif
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('SkinProfileForm.show', $profile->FormID) }}" class="btn btn-info btn-sm fixed-size-btn">
                            <i class="fas fa-eye"></i>
                        </a>
                        @if(auth()->user()->UserLevel == 0)
                        <a href="{{ route('SkinProfileForm.edit', $profile->FormID) }}" class="btn btn-warning btn-sm fixed-size-btn">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        @endif
                        <form action="{{ route('SkinProfileForm.destroy', $profile->FormID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm fixed-size-btn" onclick="return confirmDelete('{{ $profile->created_at->format('d-m-Y') }}')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $forms->links() }}
    </div>
    @endif

    <!-- Score Interpretation Information -->
    <div class="text-center mb-4">
        <h4>Score Interpretation:</h4>
        <p><strong>Based on the total score, the user's skin health is interpreted as follows:</strong></p>
        <canvas id="scoreChart" width="400" height="200"></canvas>
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
        <a href="{{ route('SkinProfileForm.create') }}" class="btn btn-primary btn-lg">
            <i class="fa fa-arrow-left mr-2"></i> Skin Assessment
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

<!-- Styles -->
<style>
    body, .container {
        background-color: #6a0dad;
        font-family: Arial, sans-serif;
        color: #fff;
    }
    .container-fluid {
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 100%;
        margin: auto;
        padding-bottom: 120px;
    }
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(13, 13, 13, 0.1);
    }
    .card-header {
        background-color: rgb(134, 72, 179);
        color: white;
        border-radius: 1px 1px 0 0;
    }
    .card-body {
        background-color: rgb(195, 160, 202);
        border-radius: 1px 1px 0 0;
    }
    .btn {
        border-radius: 30px;
    }
    .fixed-size-btn {
        width: 50px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .btn-info {
        background-color: rgb(87, 221, 219);
        border-color: rgb(0, 0, 0);
    }
    .btn-warning {
        background-color: rgb(198, 185, 42);
        border-color: rgb(5, 5, 5);
    }
    .btn-danger {
        background-color: rgb(231, 3, 7);
        border-color: rgb(2, 2, 2);
    }
    .btn-info:hover, .btn-warning:hover, .btn-danger:hover {
        opacity: 0.8;
    }
    @media (max-width: 768px) {
        .card {
            margin-bottom: 20px;
        }
        .btn {
            font-size: 14px;
        }
    }
    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
    }
    .slider {
        position: relative;
        width: 100%;
        height: 50px;
        overflow: hidden;
        border: 1px solid rgb(11, 11, 11);
        border-radius: 10px;
        background-color: rgb(183, 189, 136);
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
        color: rgb(255, 255, 255);
    }
    .bottom-navbar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgb(84, 63, 100);
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 10px 0;
        box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }
    .bottom-navbar a {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-decoration: none;
        font-size: 14px;
        padding: 5px;
        transition: color 0.3s ease, transform 0.3s ease;
    }
    .bottom-navbar a:hover {
        color: #FFD700;
        transform: scale(1.1);
    }
    .bottom-navbar i {
        font-size: 20px;
        margin-bottom: 4px;
    }
    .bottom-navbar span {
        font-size: 12px;
    }
</style>

<!-- Include Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        // Chart.js Configuration
        const ctx = document.getElementById('scoreChart').getContext('2d');
        const scoreChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Very Poor', 'Poor', 'Moderate', 'Good', 'Excellent'],
                datasets: [{
                    label: 'Skin Health Status',
                    data: [10, 15, 20, 25, 30], // Replace with actual counts for each category
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(153, 102, 255, 0.8)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white' // Set y-axis text color to white
                        }
                    },
                    x: {
                        ticks: {
                            color: 'white' // Set x-axis text color to white
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white' // Set legend text color to white
                        }
                    }
                }
            }
        });
    });
</script>
@endsection