<?php

use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Dataset;
use App\Models\Competition;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class, 'index'])
    ->name('user');

Route::get('/competitions', [CompetitionController::class, 'index'])
    ->name('competitions.index');
Route::get('/comeptitions/create', [CompetitionController::class, 'create'])->name('competitions.create');
Route::post('/competitions', [CompetitionController::class, 'store'])->name('competitions.store');
Route::get('/competitions/{id}', [CompetitionController::class, 'show'])->name('competitions.show');
Route::get('/competitions/{id}/edit', [CompetitionController::class, 'edit'])->name('competitions.edit');
Route::put('/competitions/{id}', [CompetitionController::class, 'update'])->name('competitions.update');
Route::delete('/competitions/{id}', [CompetitionController::class, 'destroy'])->name('competitions.destroy');


Route::get('/datasets/search', [DatasetController::class, 'search'])->name('datasets.search');

Route::get('/datasets', [DatasetController::class, 'index'])
    ->name('datasets.index');
Route::get('/datasets/create', [DatasetController::class, 'create'])->name('datasets.create');
Route::post('/datasets', [DatasetController::class, 'store'])->name('datasets.store');
Route::get('/datasets/{id}/edit', [DatasetController::class, 'edit'])->name('datasets.edit');
Route::put('/datasets/{id}', [DatasetController::class, 'update'])->name('datasets.update');
Route::get('/datasets/{id}', [DatasetController::class, 'show'])->name('datasets.show');
Route::delete('/datasets/{id}', [DatasetController::class, 'destroy'])->name('datasets.destroy');




Route::get('/dashboard', function () {
    $topDatasets = Dataset::orderByDesc('total_downloads')
        ->take(10)
        ->get(['dataset_name', 'total_downloads']);

    $topVotes = Dataset::orderByDesc('total_votes')
        ->take(10)
        ->get(['dataset_name', 'total_votes']);

    $topUsability = Dataset::orderByDesc('usability_rating')
        ->take(10)
        ->get(['dataset_name', 'usability_rating']);

    $topAvgVotes = Dataset::select('dataset_name', 'total_votes')  
        ->take(30)
        ->get();

    $totalOngoing = Competition::whereDate('start_date', '<=', now())
        ->whereDate('end_date', '>=', now())
        ->count();

    $averageTeams = Competition::whereNotNull('total_teams')->avg('total_teams');

    $topCompetitions = Competition::orderByDesc('prize')->limit(5)->get(['competition_name', 'prize']);

    $topHost = User::select('users.id', 'users.name', DB::raw('COUNT(competitions.id_competition) as total_hosted'))
        ->join('competitions', 'users.id', '=', 'competitions.id_user')
        ->groupBy('users.id', 'users.name')
        ->orderByDesc('total_hosted')
        ->first();

    return view('dashboard', compact('topDatasets', 'topVotes', 'topUsability', 'topAvgVotes', 'totalOngoing', 'averageTeams', 'topCompetitions', 'topHost'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
