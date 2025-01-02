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
    <h4 class="text-center mb-4">Please Rate The Severity Of Your Skin Concerns</h4>
    <!-- Back to Home Button in the Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
       
        <h1>Create New Skin Profile</h1>
       
    </div>
  
    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were errors with your submission:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('SkinProfileForm.store') }}" method="POST">
        @csrf

        <!-- Helper function for button group -->
        @php
            function renderButtonGroup($name, $selectedValue = null) {
                $buttons = '';
                for ($i = 1; $i <= 5; $i++) {
                    $isActive = $selectedValue == $i ? 'active' : '';
                    $checked = $selectedValue == $i ? 'checked' : '';
                    $buttons .= "<label class='btn btn-outline-primary $isActive'>
                                    <input type='radio' name='$name' value='$i' autocomplete='off' $checked required> $i
                                 </label>";
                }
                return $buttons;
            }
        @endphp

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
        <!-- Form Fields -->
        @foreach ([ 
            'Acne' => 'Acne', 
            'FineLine' => 'Fine Line', 
            'Darkspots' => 'Dark Spots', 
            'Redness' => 'Redness', 
            'Dryness' => 'Dryness', 
            'Oily' => 'Oily', 
            'PoresRate' => 'Pores Rate', 
            'Irritation' => 'Irritation', 
            'Firmness' => 'Firmness', 
            'Darkcircles' => 'Dark Circles' 
        ] as $fieldName => $label)
        <div class="form-group">
            <label for="{{ $fieldName }}">{{ $label }}</label>
            <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                {!! renderButtonGroup($fieldName, old($fieldName)) !!}
            </div>
            @error($fieldName)
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        @endforeach

     <!-- Buttons Section -->
<div class="form-group mt-4 d-flex flex-column flex-md-row justify-content-between">
    <button type="submit" class="btn btn-success mb-2 mb-md-0 text-nowrap" style="width: auto;">
        <i class="fa fa-save mr-2"></i> Save Profile
    </button>

    <button type="reset" class="btn btn-warning mb-2 mb-md-0 text-nowrap" style="width: auto;">
        <i class="fa fa-undo mr-2"></i> Reset Form
    </button>

    <a href="{{ route('SkinProfileForm.index') }}" class="btn btn-primary text-nowrap" style="width: auto;">
        <i class="fa fa-eye mr-2"></i> View Recent Forms
    </a>
</div>

    </form>
</div>
@endsection
