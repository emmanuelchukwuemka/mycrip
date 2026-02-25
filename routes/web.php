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
Route::get('/agents/{id}', [App\Http\Controllers\Guest\AgentController::class, 'show'])->name('agents.show');
Route::post('/reviews', [App\Http\Controllers\Guest\ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');

// Blog Routes
Route::get('/blog', [App\Http\Controllers\Guest\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [App\Http\Controllers\Guest\BlogController::class, 'show'])->name('blog.show');

// Property Request Board (Buyer Wall)
Route::get('/requests', [App\Http\Controllers\Guest\PropertyRequestController::class, 'index'])->name('requests.index');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/requests/create', [App\Http\Controllers\Guest\PropertyRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [App\Http\Controllers\Guest\PropertyRequestController::class, 'store'])->name('requests.store');
});

// Land Title Verification Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/properties/{property}/verify-title', [App\Http\Controllers\Guest\VerificationController::class, 'verify'])->name('verification.verify');
    Route::get('/verification/callback', [App\Http\Controllers\Guest\VerificationController::class, 'callback'])->name('verification.callback');
});

Route::middleware([
    'auth',
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Customer Chat Routes
    Route::get('/my-messages', [App\Http\Controllers\Guest\ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/start', [App\Http\Controllers\Guest\ChatController::class, 'start'])->name('chat.start');
    Route::get('/chat/{id}', [App\Http\Controllers\Guest\ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{id}/reply', [App\Http\Controllers\Guest\ChatController::class, 'reply'])->name('chat.reply');

    // Saved Properties
    Route::get('/my-saved-properties', [PropertyController::class, 'savedIndex'])->name('properties.saved');

    // Customer Inquiries
    Route::get('/my-inquiries', [App\Http\Controllers\Guest\InquiryController::class, 'index'])->name('inquiries.index');
    Route::get('/my-inquiries/{id}', [App\Http\Controllers\Guest\InquiryController::class, 'show'])->name('inquiries.show');
});

Route::prefix('agent')->name('agent.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Agent\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('properties', App\Http\Controllers\Agent\PropertyManagementController::class);
    Route::delete('properties/{id}/images/{imageId}', [App\Http\Controllers\Agent\PropertyManagementController::class, 'deleteImage'])->name('properties.images.delete');
    
    // Profile Routes
    Route::get('/profile/edit', [App\Http\Controllers\Agent\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\Agent\ProfileController::class, 'update'])->name('profile.update');
    
    // Add missing profile show route
    Route::get('/profile', function () {
        return redirect()->route('agent.profile.edit');
    })->name('profile');
    
    // Inquiries Routes
    Route::get('/inquiries', [App\Http\Controllers\Agent\InquiryController::class, 'index'])->name('inquiries.index');
    Route::get('/inquiries/{id}', [App\Http\Controllers\Agent\InquiryController::class, 'show'])->name('inquiries.show');

    // Chat / Messages Routes
    Route::get('/messages', [App\Http\Controllers\Agent\ChatController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [App\Http\Controllers\Agent\ChatController::class, 'show'])->name('messages.show');
    Route::post('/messages/{id}/reply', [App\Http\Controllers\Agent\ChatController::class, 'reply'])->name('messages.reply');

    // Tours Routes
    Route::get('/tours', [App\Http\Controllers\Agent\TourController::class, 'index'])->name('tours.index');
    Route::patch('/tours/{tour}', [App\Http\Controllers\Agent\TourController::class, 'updateStatus'])->name('tours.update');

    // Payment Routes
    Route::post('/properties/{property}/promote', [App\Http\Controllers\Agent\PaymentController::class, 'promote'])->name('properties.promote');
    Route::get('/payments/callback', [App\Http\Controllers\Agent\PaymentController::class, 'callback'])->name('payments.callback');

    // AI Features
    Route::post('/ai/generate-description', [App\Http\Controllers\Agent\AIController::class, 'generate'])->name('ai.generate');
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
    
    // Blog CMS
    Route::resource('blog', App\Http\Controllers\Admin\BlogController::class);
});

Route::controller(App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
    Route::match(['get', 'post'], '/logout', 'logout')->name('logout');
});

// Password Reset Routes
Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

// Google OAuth Routes
Route::get('/auth/google/redirect', [App\Http\Controllers\GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [App\Http\Controllers\GoogleAuthController::class, 'callback'])->name('google.callback');

// Static Pages
Route::get('/privacy-policy', [App\Http\Controllers\Guest\PageController::class, 'privacyPolicy'])->name('privacy.policy');
