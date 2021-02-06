<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\OfficeController;
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
});