<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProjectController as GuestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GuestController::class, 'index'])->name('guests.welcome');

/*
Route::get('/', function () {
    return view('guests.welcome');
});
*/

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// Utilizzo un group per raggruppare tutte le rotte
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group( function () {

        // CREATE
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

        // READ
        Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

        // UPDATE
        Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');

        // DESTROY
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});

/*
// CREATE
Route::get('/admin/projects/create', [ProjectController::class, 'create'])->middleware(['auth', 'verified'])->name('admin.projects.create');
Route::post('/admin/projects', [ProjectController::class, 'store'])->middleware(['auth', 'verified'])->name('admin.projects.store');

// READ
Route::get('/admin/projects', [ProjectController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.projects.index');
Route::get('/admin/projects/{project}', [ProjectController::class, 'show'])->middleware(['auth', 'verified'])->name('admin.projects.show');

// UPDATE
Route::get('/admin/projects/{project}/edit', [ProjectController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.projects.edit');
Route::put('/admin/projects/{project}', [ProjectController::class, 'update'])->middleware(['auth', 'verified'])->name('admin.projects.update');

// DESTROY
Route::delete('/admin/projects/{project}', [ProjectController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.projects.destroy');
*/



Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

require __DIR__.'/auth.php';
