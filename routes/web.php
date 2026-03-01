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
    
    // Billing & Subscription Routes
    Route::get('/billing/plans', [App\Http\Controllers\Agent\PaymentController::class, 'plans'])->name('billing.plans');
    Route::post('/subscribe/{plan}', [App\Http\Controllers\Agent\PaymentController::class, 'subscribe'])->name('agent.subscribe');
    Route::get('/subscription/callback', [App\Http\Controllers\Agent\PaymentController::class, 'subscriptionCallback'])->name('agent.subscription.callback');
    Route::delete('/subscription/{subscription}/cancel', [App\Http\Controllers\Agent\PaymentController::class, 'cancelSubscription'])->name('agent.subscription.cancel');
    Route::get('/billing/history', [App\Http\Controllers\Agent\PaymentController::class, 'billingHistory'])->name('agent.billing.history');

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

// 2FA Routes
Route::middleware('auth')->group(function () {
    Route::get('/2fa/setup', [App\Http\Controllers\Auth\TwoFactorController::class, 'showSetupForm'])->name('2fa.setup');
    Route::post('/2fa/enable', [App\Http\Controllers\Auth\TwoFactorController::class, 'enable'])->name('2fa.enable');
    Route::post('/2fa/disable', [App\Http\Controllers\Auth\TwoFactorController::class, 'disable'])->name('2fa.disable');
    Route::get('/2fa/recovery-codes', [App\Http\Controllers\Auth\TwoFactorController::class, 'showRecoveryCodes'])->name('2fa.recovery');
    Route::post('/2fa/regenerate-codes', [App\Http\Controllers\Auth\TwoFactorController::class, 'regenerateRecoveryCodes'])->name('2fa.regenerate');
    
    Route::get('/2fa/verify', [App\Http\Controllers\Auth\TwoFactorVerificationController::class, 'showVerificationForm'])->name('2fa.verify');
    Route::post('/2fa/verify', [App\Http\Controllers\Auth\TwoFactorVerificationController::class, 'verify'])->name('2fa.verify.post');
    Route::post('/2fa/resend', [App\Http\Controllers\Auth\TwoFactorVerificationController::class, 'resend'])->name('2fa.resend');
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

// Webhook Routes
Route::post('/webhooks/paystack', [App\Http\Controllers\Webhook\PaystackController::class, 'handle'])->name('webhooks.paystack');

// ── Map & Discovery ───────────────────────────────────────────────────────────
Route::get('/properties/map', [App\Http\Controllers\Guest\PropertyController::class, 'map'])->name('properties.map');
Route::get('/properties/compare', [App\Http\Controllers\Guest\PropertyController::class, 'compare'])->name('properties.compare');
Route::get('/api/properties/map-data', [App\Http\Controllers\Guest\PropertyController::class, 'mapData'])->name('properties.map-data');

// ── Account / Privacy ─────────────────────────────────────────────────────────
Route::middleware('auth')->prefix('account')->name('account.')->group(function () {
    Route::get('/privacy',    [App\Http\Controllers\AccountController::class, 'privacy'])->name('privacy');
    Route::get('/activity',   [App\Http\Controllers\AccountController::class, 'activity'])->name('activity');
    Route::get('/security',   [App\Http\Controllers\AccountController::class, 'security'])->name('security');
    Route::get('/export',     [App\Http\Controllers\AccountController::class, 'export'])->name('export');
    Route::get('/delete',     [App\Http\Controllers\AccountController::class, 'deleteShow'])->name('delete.show');
    Route::post('/delete',    [App\Http\Controllers\AccountController::class, 'deleteAccount'])->name('delete');
    Route::post('/feedback',  [App\Http\Controllers\AccountController::class, 'feedback'])->name('feedback');
});

// ── Saved Searches ────────────────────────────────────────────────────────────
Route::middleware('auth')->prefix('saved-searches')->name('saved-searches.')->group(function () {
    Route::get('/', [App\Http\Controllers\Guest\SavedSearchController::class, 'index'])->name('index');
    Route::post('/', [App\Http\Controllers\Guest\SavedSearchController::class, 'store'])->name('store');
    Route::delete('/{savedSearch}', [App\Http\Controllers\Guest\SavedSearchController::class, 'destroy'])->name('destroy');
});

// ── Disputes ──────────────────────────────────────────────────────────────────
Route::middleware('auth')->prefix('disputes')->name('disputes.')->group(function () {
    Route::get('/', [App\Http\Controllers\Guest\DisputeController::class, 'index'])->name('index');
    Route::post('/', [App\Http\Controllers\Guest\DisputeController::class, 'store'])->name('store');
});

// ── Newsletter ────────────────────────────────────────────────────────────────
Route::post('/newsletter/subscribe', [App\Http\Controllers\Guest\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [App\Http\Controllers\Guest\NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// ── Support / FAQ / Tickets ───────────────────────────────────────────────────
Route::get('/faq', [App\Http\Controllers\Guest\SupportController::class, 'faq'])->name('faq');
Route::middleware('auth')->prefix('support')->name('support.')->group(function () {
    Route::get('/tickets',            [App\Http\Controllers\Guest\SupportController::class, 'tickets'])->name('tickets');
    Route::get('/tickets/create',     [App\Http\Controllers\Guest\SupportController::class, 'createTicket'])->name('tickets.create');
    Route::post('/tickets',           [App\Http\Controllers\Guest\SupportController::class, 'storeTicket'])->name('tickets.store');
    Route::get('/tickets/{ticket}',   [App\Http\Controllers\Guest\SupportController::class, 'showTicket'])->name('tickets.show');
    Route::post('/tickets/{ticket}/reply', [App\Http\Controllers\Guest\SupportController::class, 'replyTicket'])->name('tickets.reply');
});

// ── Agent Analytics & New Features ───────────────────────────────────────────
Route::prefix('agent')->name('agent.')->middleware('auth')->group(function () {
    Route::get('/analytics', [App\Http\Controllers\Agent\AnalyticsController::class, 'index'])->name('analytics');

    // Property Document Management
    Route::post('/properties/{property}/documents', [App\Http\Controllers\Agent\PropertyDocumentController::class, 'store'])->name('properties.documents.store');
    Route::delete('/properties/{property}/documents/{document}', [App\Http\Controllers\Agent\PropertyDocumentController::class, 'destroy'])->name('properties.documents.destroy');

    // Message Templates
    Route::get('/message-templates', [App\Http\Controllers\Agent\MessageTemplateController::class, 'index'])->name('message-templates.index');
    Route::post('/message-templates', [App\Http\Controllers\Agent\MessageTemplateController::class, 'store'])->name('message-templates.store');
    Route::put('/message-templates/{template}', [App\Http\Controllers\Agent\MessageTemplateController::class, 'update'])->name('message-templates.update');
    Route::delete('/message-templates/{template}', [App\Http\Controllers\Agent\MessageTemplateController::class, 'destroy'])->name('message-templates.destroy');
});

// ── Admin Extended ────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    // Support Tickets
    Route::get('/tickets', [App\Http\Controllers\Admin\AdminSupportController::class, 'tickets'])->name('tickets');
    Route::get('/tickets/{ticket}', [App\Http\Controllers\Admin\AdminSupportController::class, 'showTicket'])->name('tickets.show');
    Route::post('/tickets/{ticket}/reply', [App\Http\Controllers\Admin\AdminSupportController::class, 'replyTicket'])->name('tickets.reply');
    // Disputes
    Route::get('/disputes', [App\Http\Controllers\Admin\AdminSupportController::class, 'disputes'])->name('disputes');
    Route::patch('/disputes/{dispute}/resolve', [App\Http\Controllers\Admin\AdminSupportController::class, 'resolveDispute'])->name('disputes.resolve');
    // FAQs
    Route::get('/faqs', [App\Http\Controllers\Admin\AdminSupportController::class, 'faqs'])->name('faqs');
    Route::post('/faqs', [App\Http\Controllers\Admin\AdminSupportController::class, 'storeFaq'])->name('faqs.store');
    Route::put('/faqs/{faq}', [App\Http\Controllers\Admin\AdminSupportController::class, 'updateFaq'])->name('faqs.update');
    Route::delete('/faqs/{faq}', [App\Http\Controllers\Admin\AdminSupportController::class, 'destroyFaq'])->name('faqs.destroy');
    // Newsletter
    Route::get('/newsletter', [App\Http\Controllers\Admin\AdminSupportController::class, 'newsletter'])->name('newsletter');
    Route::post('/newsletter/send', [App\Http\Controllers\Admin\AdminSupportController::class, 'sendNewsletter'])->name('newsletter.send');
    // Market Insights
    Route::get('/insights', [App\Http\Controllers\Admin\AdminSupportController::class, 'insights'])->name('insights');
    // Log Viewer
    Route::get('/logs', [App\Http\Controllers\Admin\AdminSupportController::class, 'logs'])->name('logs');
    // Property Documents
    Route::get('/documents', [App\Http\Controllers\Admin\AdminSupportController::class, 'pendingDocuments'])->name('documents');
    Route::patch('/documents/{document}/verify', [App\Http\Controllers\Admin\AdminSupportController::class, 'verifyDocument'])->name('documents.verify');
});

// ── Sitemap ───────────────────────────────────────────────────────────────────
Route::get('/sitemap.xml', function () {
    $properties = App\Models\Property::approved()->get(['id','updated_at']);
    $agents     = App\Models\User::where('role','agent')->get(['id','updated_at']);
    $posts      = App\Models\BlogPost::where('is_published', true)->get(['slug','updated_at']);

    $content = '<?xml version="1.0" encoding="UTF-8"?>';
    $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    $staticPages = ['/', '/properties', '/agents', '/blog', '/faq'];
    foreach ($staticPages as $page) {
        $content .= "<url><loc>" . url($page) . "</loc><changefreq>weekly</changefreq><priority>0.8</priority></url>";
    }
    foreach ($properties as $p) {
        $content .= "<url><loc>" . route('properties.show', $p->id) . "</loc><lastmod>" . $p->updated_at->toAtomString() . "</lastmod><changefreq>weekly</changefreq><priority>0.7</priority></url>";
    }
    foreach ($agents as $a) {
        $content .= "<url><loc>" . route('agents.show', $a->id) . "</loc><lastmod>" . $a->updated_at->toAtomString() . "</lastmod><priority>0.6</priority></url>";
    }
    foreach ($posts as $post) {
        $content .= "<url><loc>" . route('blog.show', $post->slug) . "</loc><lastmod>" . $post->updated_at->toAtomString() . "</lastmod><priority>0.6</priority></url>";
    }
    $content .= '</urlset>';

    return response($content, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');

