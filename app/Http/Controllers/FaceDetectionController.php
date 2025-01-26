<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FacePPService;
use App\Models\FaceAnalysis;
use Auth;

class FaceDetectionController extends Controller
{
    protected $facePPService;

    public function __construct(FacePPService $facePPService)
    {
        $this->facePPService = $facePPService;
    }
    
    public function detect(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
        ]);
    
        $imagePath = $request->file('image')->path();
        $result = $this->facePPService->detectFace($imagePath);
    
        $analysis = $this->analyzeSkin($result);
    
        // Save the analysis to the database
        FaceAnalysis::create([
            'user_id' => Auth::id(),
            'analysis' => $analysis,
        ]);
    
        // Retrieve past analyses with pagination
        $pastAnalyses = FaceAnalysis::where('user_id', Auth::id())->paginate(5);
    
        return view('face-detection-result', ['result' => $result, 'analysis' => $analysis, 'pastAnalyses' => $pastAnalyses]);
    }

    public function showPastAnalyses()
    {
        // Retrieve past analyses with pagination
        $pastAnalyses = FaceAnalysis::where('user_id', Auth::id())->paginate(5);

        return view('past-analyses', ['pastAnalyses' => $pastAnalyses]);
    }

    private function analyzeSkin($result)
    {
        $analysis = [];

        if (isset($result['faces']) && count($result['faces']) > 0) {
            $face = $result['faces'][0];
            $attributes = $face['attributes'];

            // Gender
            $analysis['gender'] = $attributes['gender']['value'];

            // Age
            $analysis['age'] = $attributes['age']['value'];

            // Smile
            $analysis['smile'] = $attributes['smile']['value'] > 50 ? 'Smiling' : 'Not Smiling';

            // Head Pose
            $analysis['headpose'] = [
                'pitch' => $attributes['headpose']['pitch_angle'],
                'roll' => $attributes['headpose']['roll_angle'],
                'yaw' => $attributes['headpose']['yaw_angle']
            ];

            // Blur
            $analysis['blur'] = $attributes['blur']['blurness']['value'] < 50 ? 'Clear' : 'Blurry';

            // Eye Status
            $analysis['eye_status'] = [
                'left_eye' => $attributes['eyestatus']['left_eye_status']['no_glass_eye_open'] > 50 ? 'Open' : 'Closed',
                'right_eye' => $attributes['eyestatus']['right_eye_status']['no_glass_eye_open'] > 50 ? 'Open' : 'Closed'
            ];

            // Emotion
            $analysis['emotion'] = array_keys($attributes['emotion'], max($attributes['emotion']))[0];

            // Face Quality
            $analysis['face_quality'] = $attributes['facequality']['value'] > 70.1 ? 'Good' : 'Poor';

            // Glass
            $analysis['glass'] = $attributes['glass']['value'];

            // Dark Circles
            $analysis['dark_circles'] = $attributes['eyestatus']['left_eye_status']['dark_glasses'] > 0 || $attributes['eyestatus']['right_eye_status']['dark_glasses'] > 0 ? 'Present' : 'Absent';

            // Oily Skin
            $analysis['oily_skin'] = $attributes['blur']['blurness']['value'] > 50 ? 'Oily' : 'Normal';

            // Additional skin conditions
            $analysis['acne'] = $this->detectAcne($attributes);
            $analysis['fine_lines'] = $this->detectFineLines($attributes);
            $analysis['dark_spots'] = $this->detectDarkSpots($attributes);
            $analysis['redness'] = $this->detectRedness($attributes);
            $analysis['dryness'] = $this->detectDryness($attributes);
            $analysis['pores_rate'] = $this->detectPoresRate($attributes);
            $analysis['irritation'] = $this->detectIrritation($attributes);
            $analysis['firmness'] = $this->detectFirmness($attributes);
        }

        return $analysis;
    }
    public function destroy($id)
    {
        $analysis = FaceAnalysis::findOrFail($id);
        $analysis->delete();
    
        return redirect()->route('past-analyses')->with('success', 'Analysis deleted successfully.');
    }
    private function detectAcne($attributes)
    {
        // Implement acne detection logic based on attributes
        return 'No significant acne detected';
    }

    private function detectFineLines($attributes)
    {
        // Implement fine lines detection logic based on attributes
        return 'Minimal fine lines detected';
    }

    private function detectDarkSpots($attributes)
    {
        // Implement dark spots detection logic based on attributes
        return 'Few dark spots detected';
    }

    private function detectRedness($attributes)
    {
        // Implement redness detection logic based on attributes
        return 'Mild redness detected';
    }

    private function detectDryness($attributes)
    {
        // Implement dryness detection logic based on attributes
        return 'Normal skin moisture';
    }

    private function detectPoresRate($attributes)
    {
        // Implement pores rate detection logic based on attributes
        return 'Moderate pore visibility';
    }

    private function detectIrritation($attributes)
    {
        // Implement irritation detection logic based on attributes
        return 'No significant irritation detected';
    }

    private function detectFirmness($attributes)
    {
        // Implement firmness detection logic based on attributes
        return 'Good skin firmness';
    }

    
}