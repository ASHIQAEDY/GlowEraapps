@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Skin Profile List</h1>

    
    
    <!-- Displaying existing skin profiles -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Form ID</th>
                <th>Total Score</th>
                <th>Concern Level</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forms as $profile)
            <tr>
                <td>{{ $profile->FormID }}</td>
                
                <!-- Displaying Total Score -->
                <td>{{ $profile->TotalScore }}</td>
                
                <!-- Displaying Interpretation Status (Concern Level) -->
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
                
                <!-- Actions (e.g., View, Edit, Delete) -->
                <td>
                <a href="{{ route('SkinProfileForm.show', $profile->FormID) }}" class="btn btn-info">View</a>

                    <a href="{{ route('SkinProfileForm.edit', $profile->FormID) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('SkinProfileForm.destroy', $profile->FormID) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this profile?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Score Interpretation Information -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h4>Score Interpretation:</h4>
            <p><strong>Based on the total score, the user's skin health is interpreted as follows:</strong></p>
            <ul>
                <li><strong>10-15:</strong> Excellent Skin Health</li>
                <li><strong>16-25:</strong> Good Skin Health</li>
                <li><strong>26-35:</strong> Moderate Skin Health</li>
                <li><strong>36-45:</strong> Poor Skin Health</li>
                <li><strong>46-50:</strong> Very Poor Skin Health</li>
            </ul>
        </div>
    </div>

    <!-- Button to create a new profile -->
    <a href="{{ route('SkinProfileForm.create') }}" class="btn btn-primary mt-3">Create New Profile</a>
</div>
@endsection
