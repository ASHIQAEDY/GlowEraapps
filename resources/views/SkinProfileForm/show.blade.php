@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Skin Profile Details</h1>

    <!-- Displaying Skin Profile Information -->
    <table class="table table-bordered">
        <tr>
            <th>Form ID</th>
            <td>{{ $profile->FormID }}</td>
        </tr>
        <tr>
            <th>Total Score</th>
            <td>{{ $profile->TotalScore }}</td>
        </tr>
        <tr>
            <th>Concern Level</th>
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

    <!-- Button to go back to the profile list -->
    <a href="{{ route('SkinProfileForm.index') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
