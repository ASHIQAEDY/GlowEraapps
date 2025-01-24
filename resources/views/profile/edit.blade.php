@extends('layouts.app')

@section('content')
<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    body {
        background-color: #E6E6FA; /* Light purple */
    }
    .sidebar {
        background-color: #D8BFD8; /* Slightly darker light purple */
        padding: 20px;
        height: 100%;
    }
    .main-content {
        background-color: #F8F8FF; /* Ghost white */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 60px; /* Add margin to the bottom */
    }
    .form-control {
        background-color: #E6E6FA; /* Light purple */
        color: #000000; /* Black text */
    }
    .btn-primary {
        background-color: #9370DB; /* Medium purple */
        border-color: #9370DB;
        color: #FFFFFF; /* White text */
    }
    .btn-primary:hover {
        background-color: #7B68EE; /* Medium slate blue */
        border-color: #7B68EE;
    }
    .btn-secondary {
        background-color: #D3D3D3; /* Light gray */
        border-color: #D3D3D3;
        color: #000000; /* Black text */
    }
    .btn-secondary:hover {
        background-color: #A9A9A9; /* Dark gray */
        border-color: #A9A9A9;
    }
    .nav-link {
        color: #4B0082; /* Indigo */
    }
    .nav-link.active {
        font-weight: bold;
        color: #4B0082; /* Indigo */
    }
    .card-header {
        background-color: #D8BFD8; /* Slightly darker light purple */
        color: #000000; /* Black text */
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
</style>

<div class="container">
    <div class="row">
        <div class="col-md-3 sidebar">
            <h4><i class="fas fa-user"></i> Profile Menu</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('profile.edit') }}"><i class="fas fa-edit"></i> Edit Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-key"></i> Change Password</a>
                </li>
                
            </ul>
        </div>
        <div class="col-md-9 main-content">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

                <div class="card-body">
                    <p>Welcome to the Edit Profile page. Here, you can update your personal information, including your name, email address, password, and gender. Follow the steps below to make changes to your profile.</p>

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <p><strong>Step 1:</strong> Enter your new name in the field below.</p>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <p><strong>Step 2:</strong> Enter your new email address in the field below.</p>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <p><strong>Step 3:</strong> Enter a new password if you wish to change it. Leave it blank to keep your current password.</p>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="form-text text-muted">Leave blank to keep current password.</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <p><strong>Step 4:</strong> Confirm your new password by entering it again in the field below.</p>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
                            <div class="col-md-6">
                                <p><strong>Step 5:</strong> Select your gender from the dropdown menu below.</p>
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <p><strong>Step 6:</strong> Click the "Save Changes" button to update your profile information or the "Cancel" button to discard changes.</p>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save Changes') }}
                                </button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
@endsection