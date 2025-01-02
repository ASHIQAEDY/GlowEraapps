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
    <h1>Edit Skin Profile</h1>
    
    <form action="{{ route('SkinProfileForm.update', $profile->FormID) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- List of attributes for the skin profile -->
        @php
            $attributes = [
                'Acne' => $profile->Acne,
                'FineLine' => $profile->FineLine,
                'Darkspots' => $profile->Darkspots,
                'Redness' => $profile->Redness,
                'Dryness' => $profile->Dryness,
                'Oily' => $profile->Oily,
                'PoresRate' => $profile->PoresRate,
                'Irritation' => $profile->Irritation,
                'Firmness' => $profile->Firmness,
                'Darkcircles' => $profile->Darkcircles
            ];

            // Helper function to render button group for each attribute
            function renderButtonGroup($name, $selectedValue = null) {
                $buttons = '';
                for ($i = 1; $i <= 5; $i++) {
                    $isActive = $selectedValue == $i ? 'active' : '';
                    $buttons .= "<label class='btn btn-outline-primary $isActive'>
                                    <input type='radio' name='$name' value='$i' autocomplete='off'> $i
                                 </label>";
                }
                return $buttons;
            }
        @endphp

        <!-- Loop through attributes and generate form fields -->
        @foreach($attributes as $attribute => $value)
            <div class="form-group">
                <label for="{{ $attribute }}">
                    {{ ucfirst(str_replace('Line', ' Line', $attribute)) }}
                </label>
                <div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
                    {!! renderButtonGroup($attribute, old($attribute, $value)) !!}
                </div>
            </div>
        @endforeach

        <!-- Update button  -->
        <button type="submit" class="btn btn-success mt-3">
            <i class="fa fa-save mr-2"></i> Update
        </button>

       <!-- Cancel button  -->
<a href="{{ route('SkinProfileForm.index') }}" class="btn btn-danger mt-3">
    <i class="fa fa-times-circle mr-2"></i> Cancel
</a>

    </form>
    
</div>
@endsection
