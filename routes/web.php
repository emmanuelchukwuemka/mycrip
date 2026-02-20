<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\PropertyController;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::prefix('properties')->name('properties.')->group(function () {
    Route::get('/', [PropertyController::class, 'index'])->name('index');
    
    // Category-specific routes (MUST be before /{id} route)
    Route::get('/categories/apartments', [PropertyController::class, 'apartments'])->name('categories.apartments');
    Route::get('/categories/houses', [PropertyController::class, 'houses'])->name('categories.houses');
    Route::get('/categories/land', [PropertyController::class, 'land'])->name('categories.land');
    Route::get('/categories/commercial', [PropertyController::class, 'commercial'])->name('categories.commercial');
    
    // Dynamic property ID route (MUST be after specific routes)
    Route::get('/{id}', [PropertyController::class, 'show'])->name('show');
    
    // Save/unsave property (requires auth)
    Route::post('/{id}/save', [PropertyController::class, 'toggleSave'])->name('save');
    
    // Submit inquiry
    Route::post('/{id}/inquiry', [PropertyController::class, 'inquiry'])->name('inquiry');
});

Route::get('/agents', [App\Http\Controllers\Guest\AgentController::class, 'index'])->name('agents.index');

Route::get('/privacy-policy', function () {
    return view('guest.privacy-policy');
})->name('privacy.policy');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::prefix('agent')->name('agent.')->middleware('auth')->group(function () {
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

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('properties', App\Http\Controllers\Admin\PropertyController::class)->only(['index', 'show']);
    Route::post('/properties/{id}/verify', [App\Http\Controllers\Admin\PropertyController::class, 'verify'])->name('properties.verify');
    Route::post('/properties/{id}/reject', [App\Http\Controllers\Admin\PropertyController::class, 'reject'])->name('properties.reject');
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->only(['index', 'show', 'destroy']);
    Route::post('/users/{id}/verify', [App\Http\Controllers\Admin\UserController::class, 'verify'])->name('users.verify');
    Route::post('/users/{id}/reject', [App\Http\Controllers\Admin\UserController::class, 'reject'])->name('users.reject');
});

Route::controller(App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
    Route::match(['get', 'post'], '/logout', 'logout')->name('logout');
});

// Google OAuth Routes
Route::get('/auth/google/redirect', [App\Http\Controllers\GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [App\Http\Controllers\GoogleAuthController::class, 'callback'])->name('google.callback');
