<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\MealEntryController;
use App\Http\Controllers\User\MarketEntryController;
use App\Http\Controllers\User\ProfileController;

use App\Http\Middleware\CheckApprovedUser;

Route::middleware(['auth', CheckApprovedUser::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Meal Entry
    Route::get('/meal-entry', [MealEntryController::class, 'create'])->name('meal_entry.create');
    Route::post('/meal-entry', [MealEntryController::class, 'store'])->name('meal_entry.store');

    // Market Entry
    Route::get('/market-entry', [MarketEntryController::class, 'create'])->name('market_entry.create');
    Route::post('/market-entry', [MarketEntryController::class, 'store'])->name('market_entry.store');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Monthly Statement (assuming it's part of the user dashboard or a separate view)
    Route::get('/statement', [DashboardController::class, 'statement'])->name('statement');

    // User Notices
    Route::get('/notices', [DashboardController::class, 'notices'])->name('notices');
});