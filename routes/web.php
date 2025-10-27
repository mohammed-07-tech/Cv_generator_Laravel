<?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CvController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('cvs.index'));

Route::middleware('auth')->group(function () {
    Route::resource('cvs', CvController::class); // index, create, store, show, edit, update, destroy
    Route::get('cvs/{cv}/preview', [CvController::class, 'preview'])->name('cvs.preview');

    //dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    //breeze profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::get('cvs/{cv}/export-pdf', [\App\Http\Controllers\CvController::class, 'exportPdf'])
        ->name('cvs.exportPdf');
});

require __DIR__ . '/auth.php';


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// //add for cv
// use App\Http\Controllers\CvController;

// Route::middleware('auth')->group(function () {
//     Route::resource('cvs', CvController::class);
// });


require __DIR__ . '/auth.php';
