<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CrudController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/download-cv', [HomeController::class, 'downloadCv'])->name('cv.download');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.send');
Route::post('/reviews', [ReviewController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('review.store');

// Route penyedia file storage publik (solusi shared hosting Rumahweb saat exec/symlink dinonaktifkan)
Route::get('/storage/{path}', function (string $path) {
    if (!\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
        abort(404);
    }
    return response()->file(\Illuminate\Support\Facades\Storage::disk('public')->path($path), [
        'Cache-Control' => 'public, max-age=31536000',
    ]);
})->where('path', '.*')->name('public.storage');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // User dashboard -> Admin dashboard
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Admin dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Portfolio profile
    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    // Website Settings
    Route::get('/admin/settings', [AdminSettingController::class, 'edit'])->name('admin.settings.edit');
    Route::put('/admin/settings', [AdminSettingController::class, 'update'])->name('admin.settings.update');
    Route::post('/admin/settings/link-storage', [AdminSettingController::class, 'linkStorage'])->name('admin.settings.link-storage');

    // Portfolio Messages (Pesan Masuk)
    Route::get('/admin/contacts/check-unread', [AdminContactController::class, 'checkUnread'])->name('admin.contacts.check-unread');
    Route::post('/admin/contacts/mark-all-read', [AdminContactController::class, 'markAllRead'])->name('admin.contacts.mark-all-read');
    Route::get('/admin/contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/admin/contacts/{id}', [AdminContactController::class, 'show'])->name('admin.contacts.show');
    Route::patch('/admin/contacts/{id}/toggle-read', [AdminContactController::class, 'toggleRead'])->name('admin.contacts.toggle-read');
    Route::delete('/admin/contacts/{id}', [AdminContactController::class, 'destroy'])->name('admin.contacts.destroy');

    // Portfolio CRUD
    Route::get('/admin/{resource}/create', [CrudController::class, 'create'])->name('admin.crud.create');
    Route::get('/admin/{resource}/{id}/edit', [CrudController::class, 'edit'])->name('admin.crud.edit');
    Route::put('/admin/{resource}/{id}', [CrudController::class, 'update'])->name('admin.crud.update');
    Route::delete('/admin/{resource}/{id}', [CrudController::class, 'destroy'])->name('admin.crud.destroy');
    Route::post('/admin/{resource}', [CrudController::class, 'store'])->name('admin.crud.store');
    Route::get('/admin/{resource}', [CrudController::class, 'index'])->name('admin.crud.index');

    // User profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';
