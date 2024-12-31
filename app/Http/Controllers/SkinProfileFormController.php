<?php

namespace App\Http\Controllers;

use App\Models\SkinProfileForm;
use Illuminate\Http\Request;

class SkinProfileFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = SkinProfileForm::all();
        return view('SkinProfileForm.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('SkinProfileForm.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'Acne' => 'nullable|integer|min:1|max:5',
            'FineLine' => 'nullable|integer|min:1|max:5',
            'Darkspots' => 'nullable|integer|min:1|max:5',
            'Redness' => 'nullable|integer|min:1|max:5',
            'Dryness' => 'nullable|integer|min:1|max:5',
            'Oily' => 'nullable|integer|min:1|max:5',
            'PoresRate' => 'nullable|integer|min:1|max:5',
            'Irritation' => 'nullable|integer|min:1|max:5',
            'Firmness' => 'nullable|integer|min:1|max:5',
            'Darkcircles' => 'nullable|integer|min:1|max:5',
        ]);
    
        // Calculate TotalScore as the sum of all input values
        $totalScore = 
            ($validatedData['Acne'] ?? 0) +
            ($validatedData['FineLine'] ?? 0) +
            ($validatedData['Darkspots'] ?? 0) +
            ($validatedData['Redness'] ?? 0) +
            ($validatedData['Dryness'] ?? 0) +
            ($validatedData['Oily'] ?? 0) +
            ($validatedData['PoresRate'] ?? 0) +
            ($validatedData['Irritation'] ?? 0) +
            ($validatedData['Firmness'] ?? 0) +
            ($validatedData['Darkcircles'] ?? 0);
    
             // Determine InterpretationStatus based on TotalScore
    $InterpretationStatus = '';
    if ($totalScore >= 10 && $totalScore <= 15) {
        $InterpretationStatus = 'Excellent Skin Health';
    } elseif ($totalScore >= 16 && $totalScore <= 25) {
        $InterpretationStatus = 'Good Skin Health';
    } elseif ($totalScore >= 26 && $totalScore <= 35) {
        $InterpretationStatus = 'Moderate Skin Health';
    } elseif ($totalScore >= 36 && $totalScore <= 45) {
        $InterpretationStatus = 'Poor Skin Health';
    } elseif ($totalScore >= 46 && $totalScore <= 50) {
        $InterpretationStatus = 'Very Poor Skin Health';
    }
        // Add the TotalScore to the validated data
        $validatedData['TotalScore'] = $totalScore;
        $validatedData['InterpretationStatus'] = $InterpretationStatus;

        // Save the data in the database
        SkinProfileForm::create($validatedData);
    
       // Redirect or return a response
    return redirect()->route('SkinProfileForm.index')
    ->with('success', 'Skin profile created successfully with a Total Score of ' . $totalScore . ' (' . $InterpretationStatus . ')!');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(SkinProfileForm $SkinProfileForm)
    {
        // The model instance is already injected, so you can use it directly
        $profile = $SkinProfileForm;
    
        // Pass the profile to the view
        return view('SkinProfileForm.show', compact('profile'));
    }
    
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($FormID)
{
    // Find the skin profile by the custom primary key 'FormID'
    $profile = SkinProfileForm::findOrFail($FormID);

    // Pass the profile to the edit view
    return view('SkinProfileForm.edit', compact('profile'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SkinProfileForm $SkinProfileForm)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'Acne' => 'required|integer|min:1|max:5',
            'FineLine' => 'required|integer|min:1|max:5',
            'Darkspots' => 'required|integer|min:1|max:5',
            'Redness' => 'required|integer|min:1|max:5',
            'Dryness' => 'required|integer|min:1|max:5',
            'Oily' => 'required|integer|min:1|max:5',
            'PoresRate' => 'required|integer|min:1|max:5',
            'Irritation' => 'required|integer|min:1|max:5',
            'Firmness' => 'required|integer|min:1|max:5',
            'Darkcircles' => 'required|integer|min:1|max:5',
        ]);
    
        // Update the profile with the validated data
        $SkinProfileForm->update($validatedData);
    
        // Redirect to the skin profile list with a success message
        return redirect()->route('SkinProfileForm.index')
                         ->with('success', 'Skin Profile updated successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SkinProfileForm $SkinProfileForm)
    {
        //
    }
}
