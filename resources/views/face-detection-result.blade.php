@extends('layouts.app')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    body, .container {
        background-color: #6a0dad;
        font-family: Arial, sans-serif;
        color: #fff;
    }

    .container {
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 100%;
        margin: auto;
        padding-bottom: 120px;
    }

    .btn, .form-control {
        border-radius: 10px;
        border: none;
        color: #fff;
        background-color: #6a0dad;
    }

    .btn:hover {
        background-color: #5d3fd3;
    }

    .form-control {
        margin-bottom: 15px;
        background-color: #8a2be2;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
    }

    .face-result {
        background-color: #fff;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        color: #000;
    }

    .face-result h2 {
        text-align: center;
        margin-bottom: 15px;
    }

    .face-result p {
        margin-bottom: 8px;
    }

    .face-result img {
        display: block;
        margin: 0 auto 15px;
        max-width: 100%;
        border-radius: 10px;
    }

    .popup-message {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #4b0082;
        color: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        opacity: 0;
        transition: opacity 0.5s, transform 0.5s;
        z-index: 1000;
        max-width: 90%;
        width: auto;
    }

    .popup-message.show {
        opacity: 1;
        transform: translate(-50%, -50%);
    }

    .popup-message .close-btn {
        background: none;
        border: none;
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        position: absolute;
        top: 5px;
        right: 10px;
    }

    @media (max-width: 576px) {
        .popup-message {
            padding: 10px;
        }

        .popup-message .close-btn {
            font-size: 16px;
        }
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

    .container {
        padding-bottom: 60px;
    }
</style>

@section('content')
<div class="container">
    <h1>Face Detection Result</h1>
    @if(isset($result['faces']) && count($result['faces']) > 0)
        <div class="face-result">
            <h2>Current Analysis</h2>
            <p><strong>Gender:</strong> {{ $analysis['gender'] }}</p>
            <p><strong>Face Age:</strong> {{ $analysis['age'] }}</p>
            <p><strong>Smile:</strong> {{ $analysis['smile'] }}</p>
            
            <p><strong>Blur:</strong> {{ $analysis['blur'] }}</p>
            <p><strong>Eye Status:</strong> Left Eye: {{ $analysis['eye_status']['left_eye'] }}, Right Eye: {{ $analysis['eye_status']['right_eye'] }}</p>
            <p><strong>Dominant Emotion:</strong> {{ ucfirst($analysis['emotion']) }}</p>
            <p><strong>Face Quality:</strong> {{ $analysis['face_quality'] }}</p>
            <p><strong>Glass:</strong> {{ $analysis['glass'] }}</p>
            <p><strong>Dark Circles:</strong> {{ $analysis['dark_circles'] }}</p>
            <p><strong>Oily Skin:</strong> {{ $analysis['oily_skin'] }}</p>
            <p><strong>Acne:</strong> {{ $analysis['acne'] }}</p>
            <p><strong>Fine Lines:</strong> {{ $analysis['fine_lines'] }}</p>
            <p><strong>Dark Spots:</strong> {{ $analysis['dark_spots'] }}</p>
            <p><strong>Redness:</strong> {{ $analysis['redness'] }}</p>
            <p><strong>Dryness:</strong> {{ $analysis['dryness'] }}</p>
            <p><strong>Pores Rate:</strong> {{ $analysis['pores_rate'] }}</p>
            <p><strong>Irritation:</strong> {{ $analysis['irritation'] }}</p>
            <p><strong>Firmness:</strong> {{ $analysis['firmness'] }}</p>
        </div>
    @else
        <p>No faces detected.</p>
    @endif

    <div class="button-group mt-3">
        <a href="{{ route('face-detection.index') }}" class="btn btn-primary">Back to Face Analysis</a>
        @if(isset($analysis['id']))
            <form action="{{ route('face-detection.destroy', $analysis['id']) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this analysis?')">Delete Analysis</button>
            </form>
        @endif
    </div>
</div>

<!-- Pop-up message -->
<div class="popup-message" id="popup">
    <button class="close-btn" onclick="closePopup()">&times;</button>
    <p>Face detection completed!</p>
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
@endsection