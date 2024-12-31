@extends('layouts.app')

@section('content')
<div class="container">
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

            // Helper function for button group
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

        <!-- Loop through attributes and generate the form fields -->
        @foreach($attributes as $attribute => $value)
            <div class="form-group">
                <label for="{{ $attribute }}">{{ ucfirst(str_replace('Line', ' Line', $attribute)) }}</label>
                <div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
                    {!! renderButtonGroup($attribute, old($attribute, $value)) !!}
                </div>
            </div>
        @endforeach

        <button type="submit" class="btn btn-success mt-3">Update Profile</button>
    </form>
</div>
@endsection
