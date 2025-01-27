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

    /* Fixed Size Button Styling */
    .fixed-size-btn {
        
        width: 150px; /* Fixed width */
        height: 40px; /* Fixed height */
        display: flex;
        justify-content: center;
        align-items: center;
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

    /* Heading Styling */
    h1 {
        text-align: center; /* Center the heading */
        margin-bottom: 30px; /* Add space below the heading */
    }

    /* Tip Card Styling */
    .tip-card {
        background-color: rgba(196, 163, 184, 0.73);
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

    /* Pagination Styling */
    .pagination {
        justify-content: end;
    }
    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }
    .page-item .page-link {
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }
    .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
    .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }
    .page-link:hover {
        color: #0056b3;
        text-decoration: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
</style>

@section('content')
<div class="container">
    <h1>SKIN HEALTH TIPS</h1>
    
    <!-- Search Form -->
    <form method="GET" action="{{ route('Tips.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by category or title" value="{{ request()->query('search') }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <!-- Conditionally show the "Create New Tip" button only if the user has UserLevel = 0 -->
    @if(Auth::user()->UserLevel == 0)
        <div class="button-group mt-3">
            <a href="{{ route('Tips.create') }}" class="btn btn-success fixed-size-btn"><i class="fa fa-plus-circle"></i> Create New Tip</a>
        </div>
    @endif

    <!-- Check if there are any success messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Show all the tips -->
    @if($tips->isEmpty())
        <div class="alert alert-warning">
            No tips found. 
            <div class="button-group mt-3">
                <a href="{{ route('Tips.index') }}" class="btn btn-secondary fixed-size-btn">Back</a>
                
            </div>
        </div>
    @else
        <ul>
            @foreach($tips as $tip)
                <li>
                    <!-- Tip Card -->
                    <div class="tip-card">
                        <h3>{{ $tip->title }}</h3>
                        <small>Category: {{ $tip->category }}<br>Updated at: {{ $tip->updated_at->format('d M Y, h:i A') }}</small>

                        <div class="button-group" style="justify-content: space-between;">
                            <!-- View Button -->
                            <a href="{{ route('Tips.show', $tip->id) }}" class="btn btn-primary fixed-size-btn" style="background-color:rgb(228, 247, 186); color:rgb(0, 0, 0); border-color:rgb(0, 0, 0);">
    <i class="fa fa-eye" style="color:rgb(23, 31, 31);"></i> Read 
</a>

                            <!-- Conditionally show the "Edit" button only if the user has UserLevel = 0 -->
                            @if(Auth::user()->UserLevel == 0)
                                <!-- Delete Button -->
                                <form action="{{ route('Tips.destroy', $tip->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tip?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger fixed-size-btn"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        <!-- Pagination Links -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                {{ $tips->links('pagination::bootstrap-4') }}
            </ul>
        </nav>
    @endif
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