<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum', 'admin']], function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::get('/users/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('admin.customers.show');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');

    Route::get('/messages', [AdminMessageController::class, 'index'])->name('admin.messages.index');
    Route::get('/messages/create', [AdminMessageController::class, 'create'])->name('admin.messages.create');
    Route::get('/messages/{message}', [AdminMessageController::class, 'edit'])->name('admin.messages.edit');
    Route::post('/messages', [AdminMessageController::class, 'store'])->name('admin.messages.store');
    Route::put('/messages/{message}', [AdminMessageController::class, 'update'])->name('admin.messages.update');
    Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('admin.messages.destroy');

    Route::post('/media', [MediaController::class, 'store'])->name('admin.media.store');
});

Route::fallback(function () {
    return redirect()->route('dashboard');
});
