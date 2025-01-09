@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #4B0082; /* Dark purple */
    }
    .card {
        background-color: #E6E6FA; /* Light purple */
        color: black; /* White text */
    }
    .card-header {
        background-color:rgb(163, 121, 163); /* Slightly darker light purple */
        color: black; 
    }
    .form-control {
        background-color:rgb(170, 170, 201); /* Light purple */
        color: black;
    }
    .form-check-label {
        color: black; 
    }
    .btn-light-green {
        background-color: #90EE90; /* Light green */
        border-color: #90EE90;
        color: black;
    }
    .btn-light-green:hover {
        background-color: #32CD32; /* Lime green */
        border-color: #32CD32;
    }
    .btn-link-pretty {
        color:rgb(115, 92, 177);
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    .btn-link-pretty:hover {
        color:rgb(115, 92, 177); 
        text-decoration: underline;
    }
</style>
<div class="container">
    <!-- Add your image here -->
    <div class="text-center mb-4">
        <img src="{{ asset('images/gloweralogo.png') }}" alt="Login Image" class="img-fluid" style="max-width: 200px; margin: 0 auto;">
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
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

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-light-green">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link btn-link-pretty" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection