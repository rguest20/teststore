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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
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
