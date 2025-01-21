<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\Aboutus;
use Illuminate\Http\Request;

class AboutusController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aboutUs = Aboutus::first(); // Get the first record from the about_us table
        $user = auth()->user(); // Get the authenticated user
        
        return view('Aboutus.index', compact('aboutUs', 'user')); // Pass both aboutUs and user to the view
    }

  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Aboutus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'introduction' => 'required|string',
            'services' => 'required|string',
            'team_background' => 'required|string',
            'impact' => 'required|string',
            'contact' => 'required|string',
            'visual' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validate the image
            'version' => 'nullable|string',
        ]);

     // Create a new Aboutus entry
     $aboutUs = new Aboutus();
     $aboutUs->introduction = $request->introduction;
     $aboutUs->services = $request->services;
     $aboutUs->team_background = $request->team_background;
     $aboutUs->impact = $request->impact;
     $aboutUs->contact = $request->contact;
 
     // Handle image upload for the 'visual' field
     if ($request->hasFile('visual')) {
         // Get the file from the request
         $image = $request->file('visual');
 
         // Generate a unique name for the image
         $imageName = time() . '.' . $image->getClientOriginalExtension();
 
         // Store the image in the 'public/visuals' directory
         $image->storeAs('public/visuals', $imageName);
 
         // Save the image name in the database
         $aboutUs->visual = 'visuals/' . $imageName;
     }
 
     // Store the 'version'
     $aboutUs->version = $request->version;
 
     // Save the new Aboutus entry in the database
     $aboutUs->save();
 
     // Redirect to the About Us page with a success message
     return redirect()->route('Aboutus.index')->with('success', 'About Us content created successfully.');
 }

    /**
     * Display the specified resource.
     */
    public function show(Aboutus $aboutus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $aboutUs = Aboutus::findOrFail($id); // Fetch the Aboutus record by ID
        return view('Aboutus.edit', compact('aboutUs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validate the request data, including the image upload
    $validated = $request->validate([
        'introduction' => 'required|string|max:1000',
        'services' => 'required|string|max:1000',
        'team_background' => 'required|string|max:1000',
        'impact' => 'required|string|max:1000',
        'contact' => 'required|string|max:1000',
        'visual' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', // Validate image file (PNG, JPG, JPEG)
        'version' => 'required|string|max:100',
    ]);

    // Find the About Us record by ID
    $aboutUs = Aboutus::findOrFail($id);

    // Update the fields that are not related to the image
    $aboutUs->update([
        'introduction' => $validated['introduction'],
        'services' => $validated['services'],
        'team_background' => $validated['team_background'],
        'impact' => $validated['impact'],
        'contact' => $validated['contact'],
        'version' => $validated['version'],
    ]);

    // Handle image upload
    if ($request->hasFile('visual')) {
        // Delete the old image if it exists
        if ($aboutUs->visual && Storage::exists('public/visuals/' . $aboutUs->visual)) {
            Storage::delete('public/visuals/' . $aboutUs->visual); // Delete old image
        }

        // Generate a new image name and store it in the 'public/visuals' directory
        $imageName = time() . '.' . $request->visual->extension(); // Unique name for the image
        $request->visual->storeAs('public/visuals', $imageName); // Store in the 'public/visuals' folder

        // Update the image path in the database
        $aboutUs->update([
            'visual' => 'visuals/' . $imageName, // Save the path to the 'visuals' directory
        ]);
    }

    // Redirect to the About Us page with a success message
    return redirect()->route('Aboutus.index')->with('status', 'About Us updated successfully!');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aboutus $aboutus)
    {
        //
    }
    
}
