<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Users\UserCreateController;
use App\Http\Controllers\Users\UserUpdateController;
use App\Http\Controllers\Users\UserDeleteController;

use App\Http\Controllers\GroupController;
use App\Http\Controllers\Groups\GroupCreateController;
use App\Http\Controllers\Groups\GroupUpdateController;
use App\Http\Controllers\Groups\GroupDeleteController;

use App\Http\Controllers\GroupPrivilegeController;
use App\Http\Controllers\GroupPrivileges\GroupPrivilegeUpdateController;

use App\Http\Controllers\GroupMessageController;
use App\Http\Controllers\GroupMessages\GroupMessageCreateController;
use App\Http\Controllers\GroupMessages\GroupMessageUpdateController;
use App\Http\Controllers\GroupMessages\GroupMessageDeleteController;
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

    Route::get('/group', [GroupController::class, 'index'])->name('group.index');
    Route::get('/group/fetch', [GroupController::class, 'fetch'])->name('group.fetch');
    Route::get('/group/create', [GroupController::class, 'create'])->name('group.create');
    Route::post('/group/store', GroupCreateController::class)->name('group.store');
    Route::get('/group/show/{id}', [GroupController::class, 'show'])->name('group.show');
    Route::post('/group/update/{id}', GroupUpdateController::class)->name('group.update');
    Route::post('/group/destroy/{id}', GroupDeleteController::class)->name('group.destroy');


    Route::get('/group-privilege', [GroupPrivilegeController::class, 'index'])->name('group-privilege.index');
    Route::get('/group-privilege/fetch', [GroupPrivilegeController::class, 'fetch'])->name('group-privilege.fetch');
    Route::post('/group-privilege/update/{groupId}/{groupPrivilegeid}', GroupPrivilegeUpdateController::class)->name('group-privilege.update');

    Route::get('/group-message', [GroupMessageController::class, 'index'])->name('group-message.index');
    Route::get('/group-message/fetch', [GroupMessageController::class, 'fetch'])->name('group-message.fetch');
    Route::get('/group-message/create', [GroupMessageController::class, 'create'])->name('group-message.create');
    Route::post('/group-message/store', GroupMessageCreateController::class)->name('group-message.store');
    Route::get('/group-message/show/{id}', [GroupMessageController::class, 'show'])->name('group-message.show');
    Route::post('/group-message/update/{id}', GroupMessageUpdateController::class)->name('group-message.update');
    Route::post('/group-message/destroy/{id}', GroupMessageDeleteController::class)->name('group-message.destroy');
});