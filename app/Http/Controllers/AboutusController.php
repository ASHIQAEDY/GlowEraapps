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
        
        // Check if $aboutUs is null and handle it
    if (!$aboutUs) {
        // Optionally, create a new Aboutus record if none exists
        $aboutUs = Aboutus::create([
            'introduction' => '',
            'services' => '',
            'team_background' => '',
            'impact' => '',
            'contact' => '',
            'visual' => '',
            'version' => '',
        ]);
    }

    return view('Aboutus.index', compact('aboutUs', 'user'));
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
        $request->validate([
            'introduction' => 'required|string',
            'services' => 'required|string',
            'team_background' => 'required|string',
            'impact' => 'required|string',
            'contact' => 'required|string',
            'visual' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'version' => 'nullable|string',
        ]);

        $aboutUs = new Aboutus();
        $aboutUs->introduction = $request->introduction;
        $aboutUs->services = $request->services;
        $aboutUs->team_background = $request->team_background;
        $aboutUs->impact = $request->impact;
        $aboutUs->contact = $request->contact;

        if ($request->hasFile('visual')) {
            $image = $request->file('visual');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/visuals', $imageName);
            $aboutUs->visual = 'visuals/' . $imageName;
        }

        $aboutUs->version = $request->version;
        $aboutUs->save();

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
        $validated = $request->validate([
            'introduction' => 'required|string|max:1000',
            'services' => 'required|string|max:1000',
            'team_background' => 'required|string|max:1000',
            'impact' => 'required|string|max:1000',
            'contact' => 'required|string|max:1000',
            'visual' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'version' => 'required|string|max:100',
        ]);

        $aboutUs = Aboutus::findOrFail($id);

        $aboutUs->update([
            'introduction' => $validated['introduction'],
            'services' => $validated['services'],
            'team_background' => $validated['team_background'],
            'impact' => $validated['impact'],
            'contact' => $validated['contact'],
            'version' => $validated['version'],
        ]);

        if ($request->hasFile('visual')) {
            if ($aboutUs->visual && Storage::exists('public/' . $aboutUs->visual)) {
                Storage::delete('public/' . $aboutUs->visual);
            }

            $imageName = time() . '.' . $request->visual->extension();
            $request->visual->storeAs('public/visuals', $imageName);
            $aboutUs->update(['visual' => 'visuals/' . $imageName]);
        }

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
