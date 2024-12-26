<?php

use App\Http\Controllers\CheckController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Register web routes for your application.
|
*/

// Redirect to login for unauthenticated users
Route::get('/', fn() => redirect(route('login')));

// Auth routes for login, registration, etc.
Auth::routes();

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Home route
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // User Management
    Route::resource('users', UserController::class)->except(['destroy']);
    
    // Admin routes
    Route::get('/admin', fn() => view('admin.index'))->name('admin.index');
    Route::get('admin', [FileUploadController::class, 'index'])->name('files');

    // File upload
    Route::get('FileUpload', [FileUploadController::class, 'getFileUploadForm'])->name('get.FileUpload');
    Route::post('FileUpload', [FileUploadController::class, 'store'])->name('store.file');

    Route::get('/download/{id}', [FileUploadController::class, 'download'])->name('download.file');
    
    // Protect specific user routes
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

   
});

// Additional route to check for deleted users
Route::get('/check-deleted', [CheckController::class, 'checkDeleted'])->name('check.deleted');

