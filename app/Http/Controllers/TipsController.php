<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Illuminate\Http\Request;

class TipsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
     public function index()
     {
         $user = auth()->user(); // Get the currently authenticated user
     
         if ($user && $user->UserLevel == 0) { // If the user is an admin (UserLevel 0)
             $tips = Tips::orderBy('created_at', 'desc')->get(); // Fetch all tips, ordered by creation date (most recent first)
         } else {
             $tips = Tips::where('user_id', 3)->orderBy('created_at', 'desc')->get(); // Only fetch tips created by the admin, ordered by creation date
         }
     
         return view('Tips.index', compact('tips'));
     }
     

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Tips.create'); // Show the create tip form
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
        ]);

        // Create a new tip in the database
        Tips::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'user_id' => auth()->id(), // Set the user_id to the logged-in user
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('Tips.index')->with('success', 'Tip created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
          // Retrieve the tip by its ID
    $tip = Tips::findOrFail($id); // This will retrieve the tip or throw a 404 error if not found

    // Return the view and pass the tip
    return view('Tips.show', compact('tip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    // Check if the user is an admin
    $user = auth()->user();
    
    // Retrieve the tip based on the given ID
    $tip = Tips::findOrFail($id);

    // Ensure that only admins can edit
    if ($user->UserLevel == 0) {
        return view('Tips.edit', compact('tip'));
    }

    // Redirect to the index if the user is not an admin
    return redirect()->route('Tips.index');
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $user = auth()->user();

    // Ensure only the admin can update
    if ($user->UserLevel != 0) {
        return redirect()->route('Tips.index');
    }

    // Validate the form data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    // Find the tip and update it
    $tip = Tips::findOrFail($id);
    $tip->update($validatedData);

    // Redirect back to the tips index page with a success message
    return redirect()->route('Tips.index')->with('success', 'Tip updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Find the tip by its ID
    $tip = Tips::find($id);

    // Check if the tip exists
    if (!$tip) {
        return redirect()->route('Tips.index')->with('error', 'Tip not found!');
    }

    // Optional: Check if the user has permission to delete this tip (for example, the user who created it)
  
    if (auth()->id() !== $tip->user_id && auth()->user()->UserLevel !== 0) {
        return redirect()->route('Tips.index')->with('error', 'You are not authorized to delete this tip!');
    }

    // Delete the tip
    $tip->delete();

    // Redirect to the index page with a success message
    return redirect()->route('Tips.index')->with('success', 'Tip deleted successfully!');
}

}
