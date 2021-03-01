<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocaleController;

use App\Http\Controllers\OfficeController;
use App\Http\Controllers\Offices\OfficeCreateController;
use App\Http\Controllers\Offices\OfficeUpdateController;
use App\Http\Controllers\Offices\OfficeDeleteController;

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\Currencies\CurrencyCreateController;
use App\Http\Controllers\Currencies\CurrencyUpdateController;
use App\Http\Controllers\Currencies\CurrencyDeleteController;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Companies\CompanyCreateController;
use App\Http\Controllers\Companies\CompanyUpdateController;
use App\Http\Controllers\Companies\CompanyDeleteController;

use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\TicketTypes\TicketTypeCreateController;
use App\Http\Controllers\TicketTypes\TicketTypeUpdateController;
use App\Http\Controllers\TicketTypes\TicketTypeDeleteController;

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Services\ServiceCreateController;
use App\Http\Controllers\Services\ServiceUpdateController;
use App\Http\Controllers\Services\ServiceDeleteController;

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

use App\Http\Controllers\DriverController;
use App\Http\Controllers\Drivers\DriverCreateController;
use App\Http\Controllers\Drivers\DriverUpdateController;
use App\Http\Controllers\Drivers\DriverDeleteController;


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
    Route::get('/office/create', [OfficeController::class, 'create'])->name('office.create');
    Route::post('/office/store', OfficeCreateController::class)->name('office.store');
    Route::get('/office/show/{id}', [OfficeController::class, 'show'])->name('office.show');
    Route::post('/office/update/{id}', OfficeUpdateController::class)->name('office.update');
    Route::post('/office/destroy/{id}', OfficeDeleteController::class)->name('office.destroy');

    Route::get('/currency', [CurrencyController::class, 'index'])->name('currency.index');
    Route::get('/currency/fetch', [CurrencyController::class, 'fetch'])->name('currency.fetch');
    Route::get('/currency/create', [CurrencyController::class, 'create'])->name('currency.create');
    Route::post('/currency/store', CurrencyCreateController::class)->name('currency.store');
    Route::get('/currency/show/{id}', [CurrencyController::class, 'show'])->name('currency.show');
    Route::post('/currency/update/{id}', CurrencyUpdateController::class)->name('currency.update');
    Route::post('/currency/destroy/{id}', CurrencyDeleteController::class)->name('currency.destroy');

    Route::get('/ticket-type', [TicketTypeController::class, 'index'])->name('ticket-type.index');
    Route::get('/ticket-type/fetch', [TicketTypeController::class, 'fetch'])->name('ticket-type.fetch');
    Route::get('/ticket-type/create', [TicketTypeController::class, 'create'])->name('ticket-type.create');
    Route::post('/ticket-type/store', TicketTypeCreateController::class)->name('ticket-type.store');
    Route::get('/ticket-type/show/{id}', [TicketTypeController::class, 'show'])->name('ticket-type.show');
    Route::post('/ticket-type/update/{id}', TicketTypeUpdateController::class)->name('ticket-type.update');
    Route::post('/ticket-type/destroy/{id}', TicketTypeDeleteController::class)->name('ticket-type.destroy');

    Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
    Route::get('/company/fetch', [CompanyController::class, 'fetch'])->name('company.fetch');
    Route::get('/company/create', [CompanyController::class, 'create'])->name('company.create');
    Route::post('/company/store', CompanyCreateController::class)->name('company.store');
    Route::get('/company/show/{id}', [CompanyController::class, 'show'])->name('company.show');
    Route::post('/company/update/{id}', CompanyUpdateController::class)->name('company.update');
    Route::post('/company/destroy/{id}', CompanyDeleteController::class)->name('company.destroy');

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

    Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/service/fetch', [ServiceController::class, 'fetch'])->name('service.fetch');
    Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('/service/store', ServiceCreateController::class)->name('service.store');
    Route::get('/service/show/{id}', [ServiceController::class, 'show'])->name('service.show');
    Route::post('/service/update/{id}', ServiceUpdateController::class)->name('service.update');
    Route::post('/service/destroy/{id}', ServiceDeleteController::class)->name('service.destroy');

    Route::get('/driver', [DriverController::class, 'index'])->name('driver.index');
    Route::get('/driver/fetch', [DriverController::class, 'fetch'])->name('driver.fetch');
    Route::get('/driver/create', [DriverController::class, 'create'])->name('driver.create');
    Route::post('/driver/store', DriverCreateController::class)->name('driver.store');
    Route::get('/driver/show/{id}', [DriverController::class, 'show'])->name('driver.show');
    Route::post('/driver/update/{id}', DriverUpdateController::class)->name('driver.update');
    Route::post('/driver/destroy/{id}', DriverDeleteController::class)->name('driver.destroy');
});