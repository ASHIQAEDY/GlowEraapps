@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    body {
        background-color: rgb(121, 56, 173); /* Dark purple background for the entire page */
        color: #fff; /* White text color */
    }
</style>
@section('content')
<div class="container" style="background-color: rgb(121, 56, 173); border-radius: 15px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 900px; margin: auto;">
     <h1 style="text-align: center; margin-bottom: 30px; color: #fff;">Create New Skin Health Tip</h1>

     <!-- Form to create a new tip -->
     <form action="{{ route('Tips.store') }}" method="POST">
         @csrf
         <div class="form-group">
             <label for="title" style="font-weight: bold; color: #fff;">Title:</label>
             <input type="text" name="title" id="title" class="form-control" required style="border-radius: 10px; border: 1px solid #dcdcdc; margin-bottom: 15px; background-color: #4b0082; color: #fff; width: 100%; padding: 10px;">
         </div>

         <div class="form-group">
             <label for="description" style="font-weight: bold; color: #fff;">Description:</label>
             <textarea name="description" id="description" class="form-control" required style="border-radius: 10px; border: 1px solid #dcdcdc; margin-bottom: 15px; background-color: #4b0082; color: #fff; width: 100%; padding: 10px;"></textarea>
         </div>

         <div class="form-group">
             <label for="category" style="font-weight: bold; color: #fff;">Category:</label>
             <input type="text" name="category" id="category" class="form-control" required style="border-radius: 10px; border: 1px solid #dcdcdc; margin-bottom: 15px; background-color: #4b0082; color: #fff; width: 100%; padding: 10px;">
         </div>

         <div class="button-group" style="display: flex; justify-content: center; gap: 15px;">
             <button type="submit" class="btn btn-primary" style="background-color:rgb(21, 152, 78); border: none; color: #fff; border-radius: 10px; padding: 10px 15px; text-align: center; display: inline-block; text-decoration: none; font-weight: bold;">
                 <i class="fa fa-check"></i> Create Tip
             </button>
         </div>
     </form>

     <div class="button-group" style="display: flex; justify-content: center; gap: 15px;">
         <a href="{{ route('Tips.index') }}" class="btn btn-secondary" style="background-color:rgb(156, 84, 146); border: none; color: #fff; border-radius: 10px; padding: 10px 15px; text-align: center; display: inline-block; text-decoration: none; font-weight: bold;">
             <i class="fa fa-arrow-left"></i> Back to Tips
         </a>
     </div>
 </div>

<!-- Bottom Navbar -->
<div class="bottom-navbar" style="position: fixed; bottom: 0; left: 0; right: 0; background-color: rgb(84, 63, 100); display: flex; justify-content: space-around; align-items: center; padding: 10px 0; box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.2); z-index: 1000;">
    <a href="{{ route('Aboutus.index') }}" style="display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; text-decoration: none; font-size: 14px; padding: 5px; transition: color 0.3s ease, transform 0.3s ease;">
        <i class="fas fa-info-circle" style="font-size: 20px; margin-bottom: 4px;"></i>
        <span style="font-size: 12px;">About Us</span>
    </a>
    <a href="{{ route('home') }}" style="display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; text-decoration: none; font-size: 14px; padding: 5px; transition: color 0.3s ease, transform 0.3s ease;">
        <i class="fas fa-home" style="font-size: 20px; margin-bottom: 4px;"></i>
        <span style="font-size: 12px;">Home</span>
    </a>
    <a href="{{ route('Tips.index') }}" style="display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; text-decoration: none; font-size: 14px; padding: 5px; transition: color 0.3s ease, transform 0.3s ease;">
        <i class="fas fa-lightbulb" style="font-size: 20px; margin-bottom: 4px;"></i>
        <span style="font-size: 12px;">Tips</span>
    </a>
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