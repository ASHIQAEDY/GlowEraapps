@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header text-white text-center" style="background-color: #6a0dad;">
            <h2>Edit About Us</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('Aboutus.update', $aboutUs->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="introduction">Introduction</label>
                    <textarea name="introduction" id="introduction" class="form-control" rows="5">{{ $aboutUs->introduction }}</textarea>
                </div>

                <div class="form-group">
                    <label for="services">Services</label>
                    <textarea name="services" id="services" class="form-control" rows="5">{{ $aboutUs->services }}</textarea>
                </div>

                <div class="form-group">
                    <label for="team_background">Team Background</label>
                    <textarea name="team_background" id="team_background" class="form-control" rows="5">{{ $aboutUs->team_background }}</textarea>
                </div>

                <div class="form-group">
                    <label for="impact">Impact</label>
                    <textarea name="impact" id="impact" class="form-control" rows="5">{{ $aboutUs->impact }}</textarea>
                </div>

                <div class="form-group">
                    <label for="contact">Contact</label>
                    <textarea name="contact" id="contact" class="form-control" rows="5">{{ $aboutUs->contact }}</textarea>
                </div>

                

                <div class="form-group">
                    <label for="version">Version</label>
                    <input type="text" name="version" id="version" class="form-control" value="{{ $aboutUs->version }}">
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Update About Us</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
