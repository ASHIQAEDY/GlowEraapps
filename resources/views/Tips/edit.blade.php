@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header text-white text-center" style="background-color: #6a0dad;">
            <h2>Edit Tip: {{ $tip->title }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('Tips.update', $tip->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $tip->title }}" required>
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" name="category" id="category" class="form-control" value="{{ $tip->category }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" required>{{ $tip->description }}</textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update Tip</button>
                </div>
            </form>

            <!-- Back Button -->
            <div class="mt-3">
                <a href="{{ route('Tips.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back to Tips</a>
            </div>
        </div>
    </div>
</div>
@endsection
