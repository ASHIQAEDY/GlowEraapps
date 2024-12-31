@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Skin Profile</h1>
    <form action="{{ route('SkinProfileForm.store') }}" method="POST">
        @csrf

        <!-- Helper function for button group -->
        @php
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

        <div class="form-group">
            <label for="Acne">Acne</label>
            <div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
                {!! renderButtonGroup('Acne', old('Acne')) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="FineLine">Fine Line</label>
            <div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
                {!! renderButtonGroup('FineLine', old('FineLine')) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="Darkspots">Dark Spots</label>
            <div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
                {!! renderButtonGroup('Darkspots', old('Darkspots')) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="Redness">Redness</label>
            <div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
                {!! renderButtonGroup('Redness', old('Redness')) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="Dryness">Dryness</label>
            <div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
                {!! renderButtonGroup('Dryness', old('Dryness')) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="Oily">Oily</label>
            <div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
                {!! renderButtonGroup('Oily', old('Oily')) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="PoresRate">Pores Rate</label>
            <div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
                {!! renderButtonGroup('PoresRate', old('PoresRate')) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="Irritation">Irritation</label>
            <div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
                {!! renderButtonGroup('Irritation', old('Irritation')) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="Firmness">Firmness</label>
            <div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
                {!! renderButtonGroup('Firmness', old('Firmness')) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="Darkcircles">Dark Circles</label>
            <div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
                {!! renderButtonGroup('Darkcircles', old('Darkcircles')) !!}
            </div>
        </div>

      
        <button type="submit" class="btn btn-success mt-3">Save Profile</button>
    </form>
</div>
@endsection
