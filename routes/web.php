<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AdminProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PortfolioController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');

    // Resource Routes (CRUD)
    Route::resource('skills', SkillController::class)->except(['create', 'show', 'edit']);
    Route::resource('projects', ProjectController::class)->except(['create', 'show', 'edit']);
    Route::resource('experiences', ExperienceController::class)->except(['create', 'show', 'edit']);
    Route::resource('contacts', ContactController::class)->except(['create', 'show', 'edit']);
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
