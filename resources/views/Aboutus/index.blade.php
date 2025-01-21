@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header text-white text-center" style="background-color: #6a0dad;">
            <h2>About Us</h2>
        </div>
        <div class="card-body">
            <h3>Introduction</h3>
            <p>{{ $aboutUs->introduction ?? 'No introduction available.' }}</p>

            <h3>Services</h3>
            <p>{{ $aboutUs->services ?? 'No services available.' }}</p>

            <h3>Team Background</h3>
            <p>{{ $aboutUs->team_background ?? 'No team background available.' }}</p>

            <h3>Impact</h3>
            <p>{{ $aboutUs->impact ?? 'No impact information available.' }}</p>

            <h3>Contact</h3>
            <p>{{ $aboutUs->contact ?? 'No contact information available.' }}</p>

            <h3>Visual</h3>
            <p>
                @if($aboutUs->visual)
                <img src="{{ asset('storage/visuals/' . $aboutUs->visual) }}" alt="Visual" class="img-fluid">

                @else
                    No visual available.
                @endif
            </p>

            <h3>Version</h3>
            <p>{{ $aboutUs->version ?? 'No version information available.' }}</p>

            <!-- Check UserLevel for Edit Button -->
            @if($user && $user->UserLevel == 0)
    <div class="mt-4 text-center">
        <!-- Pass the Aboutus model instance or its ID -->
        <a href="{{ route('Aboutus.edit', $aboutUs->id) }}" class="btn btn-primary">Edit About Us</a>
    </div>
@endif



        </div>
    </div>
</div>
@endsection
