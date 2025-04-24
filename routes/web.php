<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('change/{language}', [LanguageController::class, 'change'])->name('lang.change');

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
Route::get('/contact', [ContactController::class, 'contact']);
=======
Route::get('/#contact', function () {
    return view('welcome');
});

Route::get('/contact', [ContactController::class, 'contact'])->name('contact.contact');
>>>>>>> noutDell


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
<<<<<<< HEAD
=======

    // Route::get('change', [LanguageController::class, 'change'])->name('lang.change');
>>>>>>> noutDell
});

require __DIR__.'/auth.php';
