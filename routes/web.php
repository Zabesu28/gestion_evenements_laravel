<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// role
Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:Chef du village'])->name('admin.dashboard');

// permission
// Route::get('/create_project', function () {
//     return view('admin.projects.index');
// })->middleware(['auth', 'permission:creer_projet'])->name('admin.projects.index');

Route::middleware(['auth', 'role:Chef du village'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::put('/admin/users/{id}/role', [UserController::class, 'updateRole'])->name('admin.users.updateRole');
    Route::delete('/admin/users{id}', [UserController::class, 'destroy'])->name('admin.users.delete');
});