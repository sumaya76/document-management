<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public route - Show the welcome page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// User index route (public route if no authentication is needed)
Route::get('/user', [UserController::class, 'user'])->name('user');

// User dashboard route (ensure 'auth' middleware is applied)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // User file management routes
    Route::get('/file_manage', [UserController::class, 'file_manage'])->name('user.file_manage');
    Route::post('/upload', [UserController::class, 'uploadFile'])->name('user.upload');
    Route::get('/view/{id}', [UserController::class, 'viewFile'])->name('user.view');
    Route::delete('/delete/{id}', [UserController::class, 'deleteFile'])->name('user.delete');
    Route::patch('/users/{id}/toggle-status', [UserController::class, 'toggleUserStatus'])->name('users.toggleStatus');


    // Profile routes for authenticated users
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

// Admin routes (ensure 'auth' and 'admin' middleware are both applied)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Admin management routes
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.manageUsers');
    Route::get('/admin/categories', [AdminController::class, 'manageCategories'])->name('admin.manageCategories');
    Route::post('/admin/categories', [AdminController::class, 'storeCategory'])->name('admin.storeCategory');
    Route::put('/admin/categories/{id}', [AdminController::class, 'updateCategory'])->name('admin.updateCategory');
    Route::delete('/admin/categories/{id}', [AdminController::class, 'deleteCategory'])->name('admin.deleteCategory');

    // Admin file management
    Route::get('/admin/files', [AdminController::class, 'viewFiles'])->name('admin.viewFiles');
    Route::delete('admin/file/delete/{id}', [AdminController::class, 'deleteFile'])->name('admin.deleteFile');
});

// Auth routes
require __DIR__.'/auth.php';
