@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color:rgb(91, 65, 110)"> <!-- Purple background added here -->
    <!-- Button to go back to Home -->
    <div class="mb-4">
        <a href="{{ route('home') }}" class="btn btn-secondary p-2">
            <i class="fa fa-home"></i>
        </a>
    </div>

    <h1 class="text-center mb-4">Skin Profile Assessment</h1>
    <h2 class="text-center mb-4">Please rate the severity of your skin concerns</h2>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Displaying existing skin profiles -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered"style="background-color: #d4edda; border: 2px solid #155724;"> <!-- Green background -->
            <thead class="thead-dark">
                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

                <tr>
                    <th>Date</th>
                    <th>Total Score</th>
                    <th>Concern Level</th>
                      <!-- Add 'User ID' column conditionally -->
                      @if(Auth::user()->UserLevel == 0)
                        <th>User ID</th>
                    @endif
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($forms as $profile)
                <tr>
                    <td>{{ $profile->created_at->format('d-m-Y') }}</td>
                    <td>{{ $profile->TotalScore }}</td>
                    <td>
                        @if($profile->InterpretationStatus == 'Excellent Skin Health')
                            Excellent
                        @elseif($profile->InterpretationStatus == 'Good Skin Health')
                            Good
                        @elseif($profile->InterpretationStatus == 'Moderate Skin Health')
                            Moderate
                        @elseif($profile->InterpretationStatus == 'Poor Skin Health')
                            Poor
                        @elseif($profile->InterpretationStatus == 'Very Poor Skin Health')
                            Very Poor
                        @else
                            Not Available
                        @endif
                    </td>
                    
                      <!-- Conditionally show User ID for UserLevel 0 -->
                      @if(Auth::user()->UserLevel == 0)
                        <td>{{ $profile->user_id }}</td>
                    @endif

                    <td>
                        <a href="{{ route('SkinProfileForm.show', $profile->FormID) }}" class="btn btn-info btn-sm m-1">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('SkinProfileForm.edit', $profile->FormID) }}" class="btn btn-warning btn-sm m-1">
                            <i class="fas fa-pencil-alt"></i> Edit
                        </a>
                        <form action="{{ route('SkinProfileForm.destroy', $profile->FormID) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm m-1" onclick="return confirmDelete('{{ $profile->created_at->format('d-m-Y') }}')">
        <i class="fas fa-trash-alt"></i> Delete
    </button>
</form>

<script>
    function confirmDelete(formDate) {
        var confirmationMessage = 'Are you sure you want to delete this profile? (Form Date: ' + formDate + ')';
        return confirm(confirmationMessage);
    }
</script>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

   <!-- Score Interpretation Information -->
<div class="text-center mb-4">
    <h4>Score Interpretation:</h4>
    <p><strong>Based on the total score, the user's skin health is interpreted as follows:</strong></p>
    
    <table class="table table-bordered" style="background-color:rgb(35, 83, 46); border: 2px solid #155724;">
        <thead style="background-color:rgb(53, 16, 75); color: white;">
            <tr>
                <th>Score Range</th>
                <th>Skin Health Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>10-14</strong></td>
                <td>Excellent Skin Health</td>
            </tr>
            <tr>
                <td><strong>15-24</strong></td>
                <td>Good Skin Health</td>
            </tr>
            <tr>
                <td><strong>25-34</strong></td>
                <td>Moderate Skin Health</td>
            </tr>
            <tr>
                <td><strong>35-44</strong></td>
                <td>Poor Skin Health</td>
            </tr>
            <tr>
                <td><strong>45-50</strong></td>
                <td>Very Poor Skin Health</td>
            </tr>
        </tbody>
    </table>
</div>

    <div class="text-center mt-4">
        <a href="{{ route('SkinProfileForm.create') }}" class="btn btn-primary btn-lg">
            <i class="fa fa-arrow-left mr-2"></i> Back to Skin Assessment
        </a>
    </div>

</div>

<!-- Responsive Styles -->
<style>
    @media (max-width: 768px) {
        .table-responsive {
            padding-left: 10px;
            padding-right: 10px;
        }
        .btn {
            font-size: 14px; /* Adjust button font size for smaller screens */
        }
        .table th, .table td {
            font-size: 12px; /* Adjust table text for smaller screens */
        }
    }

    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
    }
</style>

@endsection
