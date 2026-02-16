<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\PropertyController;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::prefix('properties')->name('properties.')->group(function () {
    Route::get('/', [PropertyController::class, 'index'])->name('index');
    Route::get('/{id}', [PropertyController::class, 'show'])->name('show');
    
    // Category-specific routes
    Route::get('/apartments', [PropertyController::class, 'apartments'])->name('apartments');
    Route::get('/houses', [PropertyController::class, 'houses'])->name('houses');
    Route::get('/land', [PropertyController::class, 'land'])->name('land');
    Route::get('/commercial', [PropertyController::class, 'commercial'])->name('commercial');
});

Route::get('/agents', [App\Http\Controllers\Guest\AgentController::class, 'index'])->name('agents.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Agent\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('properties', App\Http\Controllers\Agent\PropertyManagementController::class);
    
    // Profile Routes
    Route::get('/profile/edit', function () {
        return view('agent.profile.edit');
    })->name('profile.edit');
    
    Route::put('/profile', function () {
        // Handle profile update logic here
        return redirect()->route('agent.dashboard')->with('success', 'Profile updated successfully');
    })->name('profile.update');
    
    // Add missing profile show route
    Route::get('/profile', function () {
        return redirect()->route('agent.profile.edit');
    })->name('profile');
    
    // Inquiries Routes
    Route::get('/inquiries', function () {
        return view('agent.inquiries.index');
    })->name('inquiries.index');
    
    Route::get('/inquiries/{id}', function ($id) {
        return view('agent.inquiries.show', ['inquiry' => $id]);
    })->name('inquiries.show');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('properties', App\Http\Controllers\Admin\PropertyController::class)->only(['index', 'show']);
    Route::post('/properties/{id}/verify', [App\Http\Controllers\Admin\PropertyController::class, 'verify'])->name('properties.verify');
    Route::post('/properties/{id}/reject', [App\Http\Controllers\Admin\PropertyController::class, 'reject'])->name('properties.reject');
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->only(['index', 'show', 'destroy']);
});

Route::controller(App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});


