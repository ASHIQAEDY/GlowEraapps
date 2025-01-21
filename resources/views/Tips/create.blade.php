@extends('layouts.app')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    .container {
        background-color: rgb(121, 56, 173); /* Dark purple background for the container */
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 900px; /* Limit the width for better readability */
        margin: auto; /* Center the container */
    }
    .btn-primary, .btn-secondary {
        background-color: #4b0082; /* Dark purple button color */
        border: none;
        color: #fff; /* White text color */
        border-radius: 10px;
        padding: 10px 15px;
        text-align: center;
        display: inline-block;
        text-decoration: none;
    }
    .btn-primary:hover, .btn-secondary:hover {
        background-color: #2e0854; /* Darker purple on hover */
    }
    .form-group label {
        font-weight: bold;
        color: #fff;
    }
    .form-control {
        border-radius: 10px;
        border: 1px solid #dcdcdc;
        margin-bottom: 15px;
        background-color: #4b0082; /* Dark purple background for form controls */
        color: #fff; /* White text color */
        width: 100%;
        padding: 10px;
    }
    .form-control::placeholder {
        color: #dcdcdc; /* Light grey placeholder text */
    }
    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #fff;
    }
    .button-group {
        display: flex;
        justify-content: center;
        gap: 15px;
    }
    .btn {
        padding: 10px 15px;
        border-radius: 10px;
        font-weight: bold;
    }
    a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
    }
    a:hover {
        text-decoration: underline;
    }
</style>

@section('content')
<div class="container">
     <!-- Button to go back to Home -->
     <div class="mb-4">
       <a href="{{ route('home') }}" class="btn btn-secondary p-2">
           <i class="fa fa-home"></i>
       </a>
     </div>

     <h1>Create New Skin Health Tip</h1>

     <!-- Form to create a new tip -->
     <form action="{{ route('Tips.store') }}" method="POST">
         @csrf
         <div class="form-group">
             <label for="title">Title:</label>
             <input type="text" name="title" id="title" class="form-control" required>
         </div>

         <div class="form-group">
             <label for="description">Description:</label>
             <textarea name="description" id="description" class="form-control" required></textarea>
         </div>

         <div class="form-group">
             <label for="category">Category:</label>
             <input type="text" name="category" id="category" class="form-control" required>
         </div>

         <div class="button-group">
             <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Create Tip</button>
         </div>
     </form>

     <div class="button-group">
         <a href="{{ route('Tips.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back to Tips</a>
     </div>
 </div>

@endsection

@section('scripts')
<script>
    // Initialize CKEditor on the description textarea
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection
