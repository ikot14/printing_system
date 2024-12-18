<?php
use App\Http\Controllers\CheckController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




// Redirect to login for unauthenticated users
Route::get('/', function () {
    return redirect(route('login'));
});

// Auth routes for login, registration, etc.
Auth::routes();

// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Group user management routes under authentication middleware
Route::middleware(['auth'])->group(function () {
    // User Management Routes (with resource controller for CRUD)
    Route::resource('users', UserController::class);

    // Admin route - accessible only to authenticated users
    Route::get('/admin', function () {
        return view('admin.index');  // Adjust the view path if needed
    })->name('admin.index');
});

// Protect user-related routes from being accessed by deleted users
Route::middleware(['auth'])->group(function () {
    // Specific user routes requiring the 'check.deleted' middleware
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.stor');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    
});
// Correct example of defining a named route
Route::get('/check-deleted', [CheckController::class, 'checkDeleted'])->name('check.deleted');






