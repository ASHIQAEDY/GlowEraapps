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
    .btn-secondary, .btn-primary, .btn-success, .btn-danger {
        background-color: #4b0082; /* Dark purple button color */
        border: none;
        color: #fff; /* White text color */
    }
    .btn-secondary:hover, .btn-primary:hover, .btn-success:hover, .btn-danger:hover {
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
    .face-result {
        background-color: #fff;
        border-radius: 10px;
        padding: 15px; /* Reduced padding */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .face-result h2 {
        text-align: center;
        margin-bottom: 15px; /* Reduced margin */
    }
    .face-result p {
        margin-bottom: 8px; /* Reduced margin */
    }
    .face-result img {
        display: block;
        margin: 0 auto 15px; /* Reduced margin */
        max-width: 100%; /* Ensure the image is responsive */
        border-radius: 10px; /* Optional: Add rounded corners to the image */
    }
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
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
        padding-bottom: 100px; /* Adjusted padding to the bottom */
    }
    /* Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
        font-size: 14px; /* Smaller font size */
    }
    table, th, td {
        border: 1px solid #dcdcdc;
    }
    th, td {
        padding: 5px; /* Reduced padding */
        text-align: left;
    }
    th {
        background-color: #4b0082;
        color: #fff;
    }
</style>

@section('content')
<div class="container">
    <h1>Past Face Detection Analyses</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(isset($pastAnalyses) && count($pastAnalyses) > 0)
        @foreach($pastAnalyses as $pastAnalysis)
            <div class="face-result">
                <h2>Past Analysis</h2>
                <section>
                    <p><strong>Date:</strong> {{ $pastAnalysis->created_at->format('d M Y') }}</p>
                </section>
                <table>
                    <thead>
                        <tr>
                            <th>Attribute</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pastAnalysis->analysis as $key => $value)
                            <tr>
                                <td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                                <td>
                                    @if(is_array($value))
                                        {{ implode(', ', $value) }}
                                    @else
                                        {{ $value }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <form action="{{ route('past-analyses.destroy', $pastAnalysis->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        @endforeach
        <div class="pagination">
            {{ $pastAnalyses->links() }}
        </div>
    @else
        <p>No past analyses found.</p>
    @endif
</div>

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

<!-- Pop-up Message -->
<div id="popup" class="popup">
    <button class="close-btn" onclick="closePopup()">&times;</button>
    <p>Welcome to the Face Detection Analysis page!</p>
</div>
@endsection