<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController; // Make sure to import the ProductController
use App\Http\Controllers\SkinProfileFormController;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\FaceDetectionController;
use App\Http\Controllers\UserProfileController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('Product', ProductController::class);
Route::resource('SkinProfileForm', SkinProfileFormController::class);
Route::get('views/SkinProfileForm/visualization', [SkinProfileFormController::class, 'visualization'])->name('visualization');
Route::get('SkinProfileForm/{id}', [SkinProfileFormController::class, 'show'])->name('SkinProfileForm.show');
Route::post('/skin-profile/visualization', [SkinProfileFormController::class, 'fetchDataByDate'])->name('SkinProfileForm.fetchDataByDate');
Route::get('/tips', [TipsController::class, 'index'])->name('Tips.index');
Route::get('/tips/create', [TipsController::class, 'create'])->name('Tips.create');
Route::resource('Tips', TipsController::class);
Route::get('/tips/{id}', [TipsController::class, 'show'])->name('Tips.show');
Route::resource('Aboutus', AboutusController::class);
Route::get('/Aboutus', [AboutusController::class, 'index'])->name('Aboutus.index');

Route::get('/skin-profiles', [SkinProfileFormController::class, 'index'])->name('SkinProfileForm.index');

//forfaceanalysis
Route::get('/face-detection', function () {
    return view('face-detection');
})->name('face-detection.index');

Route::post('/face-detection', [FaceDetectionController::class, 'detect'])->name('face-detection.detect');
Route::get('/past-analyses', [FaceDetectionController::class, 'showPastAnalyses'])->name('face-detection.past');
Route::get('/past-analyses', [FaceDetectionController::class, 'showPastAnalyses'])->name('past-analyses');
Route::delete('/past-analyses/{id}', [PastAnalysisController::class, 'destroy'])->name('past-analyses.destroy');
Route::get('/face-detection/past', [FaceDetectionController::class, 'showPastAnalyses'])->name('face-detection.past');
//foreditprofile


Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');

Route::get('/visualization', [SkinProfileFormController::class, 'visualization'])->name('SkinProfileForm.visualization');
Route::post('/fetchDataByDateRange', [SkinProfileFormController::class, 'fetchDataByDateRange'])->name('SkinProfileForm.fetchDataByDateRange');
//by date(analysis)
Route::get('/past-analyses', [FaceDetectionController::class, 'showPastAnalyses'])->name('past-analyses.index');