<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\CvController;

Route::get('/generer-cv', [CvController::class, 'index'])->name('index');
Route::get('/', [CvController::class, 'acceuil'])->name('aceuil');
Route::post('/save-cv', [CvController::class, 'store'])->name('save_cv');
Route::get('/afficher_cv', [CvController::class, 'afficher'])->name('afficher_cv');

// Route::post('/save-cv', [CvController::class, 'store'])->name('save.cv');
Route::get('/cv/success', function () {
    return view('cv_success');
})->name('cv.success');

Route::get('/cv/{id}', [CvController::class, 'show'])->name('cv.show');
