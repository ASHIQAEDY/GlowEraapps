@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header text-white text-center" style="background-color: #6a0dad;">
            <h2>Create About Us</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('Aboutus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="introduction">Introduction</label>
                    <textarea name="introduction" id="introduction" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="services">Services</label>
                    <textarea name="services" id="services" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="team_background">Team Background</label>
                    <textarea name="team_background" id="team_background" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="impact">Impact</label>
                    <textarea name="impact" id="impact" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="contact">Contact</label>
                    <textarea name="contact" id="contact" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="visual">Visual (Image)</label>
                    <input type="file" name="visual" id="visual" class="form-control-file">
                </div>

                <div class="form-group">
                    <label for="version">Version</label>
                    <input type="text" name="version" id="version" class="form-control">
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Create About Us</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
