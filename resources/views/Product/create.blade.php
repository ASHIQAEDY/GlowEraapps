@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    .container {
        background-color: #6a0dad; /* Dark purple background for the container */
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 600px; /* Limit the width for better readability */
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
        padding-bottom: 80px; /* Adjusted padding to the bottom */
    }

    /* Global text color to white */
body, .container, .form-control, .form-group label, .popup p, .bottom-navbar span {
    color: #fff !important;
}

/* Ensure that all placeholder text inside form controls is also white */
.form-control::placeholder {
    color: #fff !important;
}

/* Set white color for links */
a {
    color: #fff !important;
}

a:hover {
    color: #FFD700 !important; /* Optional: Change hover color */
}
</style>

@section('content')
<div class="container">
   

    <h1>Add your Product :</h1>
    <form action="{{ route('Product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="BrandName">Product Name</label>
            <input type="text" name="BrandName" class="form-control" value="{{ old('BrandName') }}" required>
            @error('BrandName')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="PurchasedDate">Purchased Date</label>
            <input type="date" name="PurchasedDate" class="form-control" value="{{ old('PurchasedDate') }}" required>
            @error('PurchasedDate')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="OpenDate">Open Date</label>
            <input type="date" name="OpenDate" class="form-control" value="{{ old('OpenDate') }}" required>
            @error('OpenDate')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="ExpiryDate">Expiry Date</label>
            <input type="date" name="ExpiryDate" class="form-control" value="{{ old('ExpiryDate') }}" required>
            @error('ExpiryDate')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
    <label for="image">
        <i class="fas fa-image"></i> Upload Product Image (Required)
    </label>
    <div class="custom-file">
        <input type="file" name="image" class="form-control" required>
    </div>
    @error('image')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
       

        <div class="button-group mt-3">
            <button type="submit" class="btn btn-success" style="background-color:rgb(176, 156, 194);">Add Product</button>
            <a href="{{ route('Product.index') }}" class="btn btn-primary text-nowrap" style="width: auto; background-color:rgb(232, 63, 238);">
                <i class="fa fa-eye mr-2"  ></i> List of Products
            </a>
        </div>
    </form>

</div>

<!-- Pop-up message -->
<div class="popup" id="popup">
    <button class="close-btn" onclick="closePopup()">&times;</button>
    <p>Welcome!</p><p> Create your new product, fill in the details and click "Add Product".</p>
      <p>   You can also view your recent forms by clicking "List of Products".</p>
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