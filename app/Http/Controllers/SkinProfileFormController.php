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
        
    ], [
        'required' => 'The :attribute field is required.',
        'integer' => 'The :attribute field must be an integer.',
        'min' => 'The :attribute value must be at least 1.',
        'max' => 'The :attribute value must not exceed 5.',
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
    public function update(Request $request, $id)
    {
        // Validate only the fields that are sent in the request
        $request->validate([
            'Acne' => 'nullable|integer|between:1,5',
            'FineLine' => 'nullable|integer|between:1,5',
            'Darkspots' => 'nullable|integer|between:1,5',
            'Redness' => 'nullable|integer|between:1,5',
            'Dryness' => 'nullable|integer|between:1,5',
            'Oily' => 'nullable|integer|between:1,5',
            'PoresRate' => 'nullable|integer|between:1,5',
            'Irritation' => 'nullable|integer|between:1,5',
            'Firmness' => 'nullable|integer|between:1,5',
            'Darkcircles' => 'nullable|integer|between:1,5',
        ]);
    
        // Find the profile by ID
        $profile = SkinProfileForm::findOrFail($id);
    
        // Only update the fields that are present in the request
        if ($request->has('Acne')) {
            $profile->Acne = $request->Acne;
        }
        if ($request->has('FineLine')) {
            $profile->FineLine = $request->FineLine;
        }
        if ($request->has('Darkspots')) {
            $profile->Darkspots = $request->Darkspots;
        }
        if ($request->has('Redness')) {
            $profile->Redness = $request->Redness;
        }
        if ($request->has('Dryness')) {
            $profile->Dryness = $request->Dryness;
        }
        if ($request->has('Oily')) {
            $profile->Oily = $request->Oily;
        }
        if ($request->has('PoresRate')) {
            $profile->PoresRate = $request->PoresRate;
        }
        if ($request->has('Irritation')) {
            $profile->Irritation = $request->Irritation;
        }
        if ($request->has('Firmness')) {
            $profile->Firmness = $request->Firmness;
        }
        if ($request->has('Darkcircles')) {
            $profile->Darkcircles = $request->Darkcircles;
        }
    
     // Calculate the total score based on the updated attributes
     $totalScore = $profile->Acne + $profile->FineLine + $profile->Darkspots + 
     $profile->Redness + $profile->Dryness + $profile->Oily + 
     $profile->PoresRate + $profile->Irritation + $profile->Firmness + 
     $profile->Darkcircles;

// Update the total score
$profile->TotalScore = $totalScore;
// Set the interpretation status based on the total score using the new ranges
if ($totalScore >= 10 && $totalScore <= 14) {
    $profile->InterpretationStatus = 'Excellent Skin Health';
} elseif ($totalScore >= 15 && $totalScore <= 24) {
    $profile->InterpretationStatus = 'Good Skin Health';
} elseif ($totalScore >= 25 && $totalScore <= 34) {
    $profile->InterpretationStatus = 'Moderate Skin Health';
} elseif ($totalScore >= 35 && $totalScore <= 44) {
    $profile->InterpretationStatus = 'Poor Skin Health';
} elseif ($totalScore >= 45 && $totalScore <= 50) {
    $profile->InterpretationStatus = 'Very Poor Skin Health';
}

// Save the changes to the database
$profile->save();

// Redirect with success message
return redirect()->route('SkinProfileForm.show', $profile->FormID)->with('success', 'Profile updated successfully!');
    }
    
    
 /**
 * Remove the specified resource from storage.
 */
public function destroy(SkinProfileForm $SkinProfileForm)
{
    // Store the date of the profile being deleted
    $deletedDate = $SkinProfileForm->created_at->format('d-m-Y');

    // Check if SoftDeletes is used
    if (method_exists($SkinProfileForm, 'forceDelete')) {
        // If SoftDeletes is enabled, use forceDelete to permanently delete
        $SkinProfileForm->forceDelete();
    } else {
        // If SoftDeletes is not enabled, use delete()
        $SkinProfileForm->delete();
    }

    // Redirect back with a success message that includes the deleted date
    return redirect()->route('SkinProfileForm.index')->with('success', "Skin assessment profile from {$deletedDate} deleted successfully!");
}

}
