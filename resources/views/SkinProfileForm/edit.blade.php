@extends('layouts.app')

<!-- Add this in the <head> section of your layout file -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

@section('content')
<div class="container-fluid text-center"> <!-- Purple background and white text -->
    @if(auth()->user()->UserLevel == 1)
    <h1>Edit your Profile</h1>
    @endif
    @if(auth()->user()->UserLevel == 0)
    <h1>Edit User Profile</h1>
    @endif
    @if(auth()->user()->UserLevel == 1)
    <!-- Guiding Information for Rating Scale -->
    <div class="mb-4">
        <p><strong>Guidance for Rating Severity:</strong> 
            <span><strong>1:</strong> No Concern</span> | 
            <span><strong>2:</strong> Mild Concern</span> | 
            <span><strong>3:</strong> Moderate Concern</span> | 
            <span><strong>4:</strong> High Concern</span> | 
            <span><strong>5:</strong> Very High Concern</span>
        </p>
    </div>
    @endif
    <form action="{{ route('SkinProfileForm.update', $profile->FormID) }}" method="POST">
        @csrf
        @method('PUT')

        @if(auth()->user()->UserLevel == 1)
        <!-- List of attributes for the skin profile -->
        @php
            $attributes = [
                'Acne' => $profile->Acne,
                'FineLine' => $profile->FineLine,
                'Darkspots' => $profile->Darkspots,
                'Redness' => $profile->Redness,
                'Dryness' => $profile->Dryness,
                'Oily' => $profile->Oily,
                'PoresRate' => $profile->PoresRate,
                'Irritation' => $profile->Irritation,
                'Firmness' => $profile->Firmness,
                'Darkcircles' => $profile->Darkcircles
            ];

            // Helper function to render button group for each attribute
            function renderButtonGroup($name, $selectedValue = null) {
                $buttons = '';
                for ($i = 1; $i <= 5; $i++) {
                    $isActive = $selectedValue == $i ? 'active' : '';
                    $buttons .= "<label class='btn btn-outline-light $isActive'>
                                    <input type='radio' name='$name' value='$i' autocomplete='off'> $i
                                 </label>";
                }
                return $buttons;
            }
        @endphp

        <!-- Loop through attributes and generate form fields -->
        @foreach($attributes as $attribute => $value)
            <div class="form-group">
                <label for="{{ $attribute }}">
                    {{ ucfirst(str_replace('Line', ' Line', $attribute)) }}
                </label>
                <div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
                    {!! renderButtonGroup($attribute, old($attribute, $value)) !!}
                </div>
            </div>
        @endforeach
        @endif

        @if(auth()->user()->UserLevel == 0)
        <!-- Advice Messages -->
        <h3>Advice Messages</h3>
        <table class="table table-bordered shadow">
            @foreach (config('advice') as $level => $messages)
                <thead>
                    <tr>
                        <th colspan="2">{{ $level }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $index => $message)
                        <tr>
                            <td>Message {{ $index + 1 }}</td>
                            <td>
                                <input type="text" name="advice[{{ $level }}][{{ $index }}]" class="form-control" value="{{ $message }}" maxlength="100">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @endforeach
        </table>
        @endif

        <!-- Update button  -->
        <button type="submit" class="btn btn-success mt-3">
            <i class="fa fa-save mr-2"></i> Update
        </button>

        <!-- Cancel button  -->
        <a href="{{ route('SkinProfileForm.index') }}" class="btn btn-danger mt-3">
            <i class="fa fa-times-circle mr-2"></i> Cancel
        </a>
    </form>
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
    .container-fluid {
        background-color: rgb(91, 65, 110);
        color: white;
        padding-bottom: 60px;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .btn-group-toggle .btn {
        margin-bottom: 0.5rem;
    }
    .form-control {
        max-width: 100%;
    }
    .btn {
        border-radius: 20px;
    }
    .btn-success {
        background-color: #9370DB;
        border-color: #9370DB;
    }
    .btn-danger {
        background-color: #8B008B;
        border-color: #8B008B;
    }
    .btn-success:hover, .btn-danger:hover {
        opacity: 0.8;
    }
    @media (max-width: 576px) {
        .form-group label {
            font-size: 14px;
        }
        .btn-group-toggle .btn {
            font-size: 12px;
        }
        .btn {
            font-size: 14px;
        }
        .form-control {
            font-size: 14px;
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
    .table {
        background-color: white;
        color: black;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .table th {
        background-color: #9370DB;
        color: white;
    }
</style>
@endsection