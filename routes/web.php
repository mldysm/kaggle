<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/competitions', function () {
    return view('competitions.competitions');
});
Route::get('/competitions/competition', function () {
    return view('competitions.competition');
});
Route ::get('/competitions/create', function () {
    return view('competitions.ccompetitions');
});
Route::get('/competitions/competition/edit', function () {
    return view('competitions.ecompetitions');
});

Route::get('/datasets', function () {
    return view('datasets.datasets');
});
Route::get('/datasets/dataset', function () {
    return view('datasets.dataset');
});
Route ::get('/datasets/create', function () {
    return view('datasets.cdatasets');
});
Route::get('/datasets/dataset/edit', function () {
    return view('datasets.edataset');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
