<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/pages', [AdminController::class, 'pages'])->name('admin.pages');
});

Route::get('/', fn() => redirect()->route('login'));

Auth::routes(['verify' => true]);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    
    Route::resource('news', NewsController::class);
    Route::post('news/{news}/approve', [NewsController::class, 'approve'])->name('news.approve');
    Route::post('news/{news}/reject', [NewsController::class, 'reject'])->name('news.reject');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Socialite Routes
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'can:view-admin-dashboard'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Contoh rute untuk halaman admin lainnya
    Route::get('pages', function () {
        return view('admin.pages');
    })->name('admin.pages');

    Route::get('settings', function () {
        return view('admin.settings');
    })->name('admin.settings');
});
