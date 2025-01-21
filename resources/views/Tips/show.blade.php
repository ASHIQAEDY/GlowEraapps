@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@section('content')
<div class="container py-5">
    <!-- Card for Tip Details -->
    <div class="card shadow-lg border-0">
        <div class="card-header text-white text-center" style="background-color: #6a0dad;">
            <h2 class="mb-0">{{ $tip->title ?? 'No Title Available' }}</h2>
        </div>
        <div class="card-body">
            <p class="card-text text-muted mb-4">
                <i class="fas fa-tag"></i> <strong>Category:</strong> {{ $tip->category }}
            </p>

            <div class="tip-description" style="font-size: 1.2rem; line-height: 1.8; color: #333;">
                <strong>Description:</strong>
                <p style="font-style: italic; color: #6a0dad;">Discover the secret to glowing skin and healthy living!</p>
                <p>{!! nl2br(e($tip->description)) !!}</p>
            </div>
            
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <a href="{{ route('Tips.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Tips
            </a>
           
            @if(Auth::user()->UserLevel == 0)
            <a href="{{ route('Tips.edit', $tip->id) }}" class="btn btn-secondary"><i class="fa fa-edit"></i> Edit</a>
            @endif
        </div>
        

    <!-- Additional Section: Fun Fact -->
    <div class="mt-5 p-4 bg-light rounded shadow">
        <h4 class="text-center text-secondary"><i class="fas fa-lightbulb"></i> Fun Fact About Skin Health</h4>
        <p class="text-center mt-3" style="font-size: 1.1rem;">
            Did you know? Your skin renews itself approximately every 28 days. Taking care of it daily can work wonders!
        </p>
    </div>
</div>
@endsection
