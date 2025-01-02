@extends('layouts.app')
<!-- Add this in the <head> section of your layout file -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@section('content')
<div class="container">
     <!-- Button to go back to Home -->
     <div class="mb-4">
        <a href="{{ route('home') }}" class="btn btn-secondary p-2">
            <i class="fa fa-home"></i>
        </a>
    </div>
    <h1>Skin Profile Details</h1>

    <!-- Displaying success or error message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Displaying Skin Profile Information -->
    <table class="table table-bordered">
        
        <tr>
            <th>Your Total Score : </th>
            <td>{{ $profile->TotalScore }}</td>
        </tr>
        <tr>
            <th>Concern Level :</th>
            <td>
                @if($profile->InterpretationStatus == 'Excellent Skin Health')
                    Excellent Skin Health
                @elseif($profile->InterpretationStatus == 'Good Skin Health')
                    Good Skin Health
                @elseif($profile->InterpretationStatus == 'Moderate Skin Health')
                    Moderate Skin Health
                @elseif($profile->InterpretationStatus == 'Poor Skin Health')
                    Poor Skin Health
                @elseif($profile->InterpretationStatus == 'Very Poor Skin Health')
                    Very Poor Skin Health
                @else
                    Not Available
                @endif
            </td>
        </tr>
        <tr>
            <th>Acne</th>
            <td>{{ $profile->Acne }}</td>
        </tr>
        <tr>
            <th>Fine Line</th>
            <td>{{ $profile->FineLine }}</td>
        </tr>
        <tr>
            <th>Dark Spots</th>
            <td>{{ $profile->Darkspots }}</td>
        </tr>
        <tr>
            <th>Redness</th>
            <td>{{ $profile->Redness }}</td>
        </tr>
        <tr>
            <th>Dryness</th>
            <td>{{ $profile->Dryness }}</td>
        </tr>
        <tr>
            <th>Oily</th>
            <td>{{ $profile->Oily }}</td>
        </tr>
        <tr>
            <th>Pores Rate</th>
            <td>{{ $profile->PoresRate }}</td>
        </tr>
        <tr>
            <th>Irritation</th>
            <td>{{ $profile->Irritation }}</td>
        </tr>
        <tr>
            <th>Firmness</th>
            <td>{{ $profile->Firmness }}</td>
        </tr>
        <tr>
            <th>Dark Circles</th>
            <td>{{ $profile->Darkcircles }}</td>
        </tr>
    </table>

   <!-- Buttons for actions -->
<a href="{{ route('SkinProfileForm.edit', $profile->FormID) }}" class="btn btn-warning">
    <i class="fa fa-edit mr-2"></i> Edit Profile
</a>
<a href="{{ route('SkinProfileForm.index') }}" class="btn btn-secondary">
    <i class="fa fa-arrow-left mr-2"></i> Back to List
</a>

</div>
@endsection
