<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ApartmentController;
// REMOVED BECAUSE OF BRIEF INDICATIONS
// use App\Http\Controllers\ProfileController;
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

// REDIRECT TO LOGIN PAGE WHEN A GUEST LANDS ON THE HOMEPAGE
Route::get('/', function () {
    return view('auth.login');
});

// REDIRECT TO DASHBOARD WHEN A REGISTERED USER LANDS ON THE HOMEPAGE
Route::get('/', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // responds to url /admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // admin.dashboard
    Route::resource('apartments', ApartmentController::class)->parameters([
        'apartments' => 'apartment:slug'
    ]);

    /* Route::resource('categories', CategoryController::class)->parameters([
        'categories' => 'category:slug'
    ])->only(['index', 'store', 'update', 'destroy']);

    Route::resource('tags', TagController::class)->parameters([
        'tags' => 'tag:slug'
    ])->only(['index', 'store', 'update', 'destroy']); */
});

// REMOVED BECAUSE OF BRIEF INDICATIONS
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';