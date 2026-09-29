<?php

use App\Http\Controllers\Api\V1\PortfolioApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| RESTful API Routes (Version 1)
|--------------------------------------------------------------------------
|
| Base URL: /api/v1
| Endpoints are rate-limited and return standardized JSON responses.
|
*/

Route::prefix('v1')->middleware('throttle:60,1')->group(function () {
    Route::get('/', [PortfolioApiController::class, 'index'])->name('api.v1.index');
    Route::get('/profile', [PortfolioApiController::class, 'profile'])->name('api.v1.profile');
    Route::get('/projects', [PortfolioApiController::class, 'projects'])->name('api.v1.projects');
    Route::get('/projects/{slug}', [PortfolioApiController::class, 'projectDetail'])->name('api.v1.projects.show');
    Route::get('/skills', [PortfolioApiController::class, 'skills'])->name('api.v1.skills');
    Route::get('/experiences', [PortfolioApiController::class, 'experiences'])->name('api.v1.experiences');
    Route::get('/education', [PortfolioApiController::class, 'education'])->name('api.v1.education');
    Route::get('/certificates', [PortfolioApiController::class, 'certificates'])->name('api.v1.certificates');
    Route::get('/services', [PortfolioApiController::class, 'services'])->name('api.v1.services');
    Route::get('/statistics', [PortfolioApiController::class, 'statistics'])->name('api.v1.statistics');
    Route::get('/reviews', [PortfolioApiController::class, 'reviews'])->name('api.v1.reviews');
    Route::get('/social-links', [PortfolioApiController::class, 'socialLinks'])->name('api.v1.social-links');
    Route::get('/settings', [PortfolioApiController::class, 'settings'])->name('api.v1.settings');

    // Send Contact Enquiry via API (rate-limited to 5 requests per minute)
    Route::post('/contacts', [PortfolioApiController::class, 'sendContact'])
        ->middleware('throttle:5,1')
        ->name('api.v1.contacts.send');
});
