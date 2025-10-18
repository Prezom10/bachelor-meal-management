<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserManageController;
use App\Http\Controllers\Admin\MealApprovalController;
use App\Http\Controllers\Admin\MarketApprovalController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\MonthlyReportController;

use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckApprovedUser;

Route::middleware(['auth', CheckApprovedUser::class, CheckAdmin::class])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::get('/users', [UserManageController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserManageController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserManageController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserManageController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/approve', [UserManageController::class, 'approve'])->name('users.approve');
    Route::post('/users/{user}/reject', [UserManageController::class, 'reject'])->name('users.reject');

    // Meal Approval
    Route::get('/meal-approvals', [MealApprovalController::class, 'index'])->name('meal_approvals.index');
    Route::post('/meal-approvals/{meal}/approve', [MealApprovalController::class, 'approve'])->name('meal_approvals.approve');
    Route::post('/meal-approvals/{meal}/reject', [MealApprovalController::class, 'reject'])->name('meal_approvals.reject');

    // Market Approval
    Route::get('/market-approvals', [MarketApprovalController::class, 'index'])->name('market_approvals.index');
    Route::post('/market-approvals/{market}/approve', [MarketApprovalController::class, 'approve'])->name('market_approvals.approve');
    Route::post('/market-approvals/{market}/reject', [MarketApprovalController::class, 'reject'])->name('market_approvals.reject');

    // Notice Management
    Route::get('/notices', [NoticeController::class, 'index'])->name('notices.index');
    Route::get('/notices/create', [NoticeController::class, 'create'])->name('notices.create');
    Route::post('/notices', [NoticeController::class, 'store'])->name('notices.store');
    Route::get('/notices/{notice}/edit', [NoticeController::class, 'edit'])->name('notices.edit');
    Route::put('/notices/{notice}', [NoticeController::class, 'update'])->name('notices.update');
    Route::delete('/notices/{notice}', [NoticeController::class, 'destroy'])->name('notices.destroy');

    // Monthly Report
    Route::get('/monthly-report', [MonthlyReportController::class, 'index'])->name('monthly_report.index');
});