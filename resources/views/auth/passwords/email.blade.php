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

    /* Card Styling */
    .card {
        background-color:rgb(48, 21, 48); /* Light grey background for the card */
        color: #000; /* Black text color */
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #4b0082;
        color: #fff;
        border-bottom: none;
        border-radius: 10px 10px 0 0;
    }
    .card-body {
        padding: 20px;
    }

    /* Alert Styling */
    .alert-success {
        background-color: #28a745;
        color: #fff;
        border-radius: 10px;
        border: none;
    }

    /* Heading Styling */
    h1 {
        text-align: center; /* Center the heading */
        margin-bottom: 30px; /* Add space below the heading */
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
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection