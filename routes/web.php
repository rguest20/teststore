<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin', function () {
    return view('admin.dashboard');
})->name('admin');

Route::middleware(['auth:sanctum', 'verified'])->post('/admin/index/',
    [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/index/{username}/create',
    [\App\Http\Controllers\AdminController::class, 'create'])->name('admin.create');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/index/{username}/destroy',
    [\App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.destroy');

Route::middleware(['auth:sanctum', 'verified'])->get('/category/index',
    [\App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');

Route::middleware(['auth:sanctum', 'verified'])->post('category/create',
    [\App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');

Route::middleware(['auth:sanctum', 'verified'])->get('category/{id}/delete',
    [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.delete');

Route::middleware(['auth:sanctum', 'verified'])->get('category/{id}/edit',
    [\App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');

Route::middleware(['auth:sanctum', 'verified'])->post('category/{id}/update',
    [\App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
