<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Users\UserCreateController;
use App\Http\Controllers\Users\UserUpdateController;
use App\Http\Controllers\Users\UserDeleteController;
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
Route::auth();

Route::get('/', function () { return redirect('/login'); });

Route::middleware(['auth'])->group(function() {
    Route::post('/locale', LocaleController::class)->name('locale');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/office', [OfficeController::class, 'index'])->name('office.index');
    Route::get('/office/fetch', [OfficeController::class, 'fetch'])->name('office.fetch');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/fetch', [UserController::class, 'fetch'])->name('user.fetch');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', UserCreateController::class)->name('user.store');
    Route::get('/user/show/{id}', [UserController::class, 'show'])->name('user.show');
    Route::post('/user/update/{id}', UserUpdateController::class)->name('user.update');
    Route::post('/user/destroy/{id}', UserDeleteController::class)->name('user.destroy');
});