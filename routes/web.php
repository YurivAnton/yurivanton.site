<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

Route::get('change/{language}', [LanguageController::class, 'change'])->name('lang.change');

Route::get('/', function () {
    return view('welcome');
});


Route::post('/contact', [ContactController::class, 'contact']);
Route::get('/#contact', function () {
    return view('welcome');
});

// Route::get('/contact', [ContactController::class, 'contact'])->name('contact.contact');

Route::get('/dashboard', [ReportController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');
Route::match(['get', 'post'], '/report', [ReportController::class, 'newReport'])->middleware(['auth', 'verified'])->name('report');
Route::post('/saveReport', [ReportController::class, 'saveReport'])->middleware(['auth', 'verified'])->name('saveReport');
Route::post('/generate-pdf', [PdfController::class, 'generate']);
Route::post('/save-send-report', [ReportController::class, 'saveAndSend'])->name('report.send');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
