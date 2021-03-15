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

use App\Http\Controllers\PrinterController;
use App\Http\Controllers\Printers\PrinterCreateController;
use App\Http\Controllers\Printers\PrinterUpdateController;
use App\Http\Controllers\Printers\PrinterDeleteController;

use App\Http\Controllers\GroupEmailController;
use App\Http\Controllers\GroupEmails\GroupEmailCreateController;
use App\Http\Controllers\GroupEmails\GroupEmailUpdateController;
use App\Http\Controllers\GroupEmails\GroupEmailDeleteController;

use App\Http\Controllers\TerminalController;
use App\Http\Controllers\Terminals\TerminalCreateController;
use App\Http\Controllers\Terminals\TerminalUpdateController;
use App\Http\Controllers\Terminals\TerminalDeleteController;

use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\Recommendations\RecommendationCreateController;
use App\Http\Controllers\Recommendations\RecommendationUpdateController;
use App\Http\Controllers\Recommendations\RecommendationDeleteController;

use App\Http\Controllers\RouteController;
use App\Http\Controllers\Routes\RouteCreateController;
use App\Http\Controllers\Routes\RouteUpdateController;
use App\Http\Controllers\Routes\RouteDeleteController;

use App\Http\Controllers\MultiRouteController;
use App\Http\Controllers\MultiRoutes\MultiRouteCreateController;
use App\Http\Controllers\MultiRoutes\MultiRouteUpdateController;
use App\Http\Controllers\MultiRoutes\MultiRouteDeleteController;

use App\Http\Controllers\PriceController;
use App\Http\Controllers\Prices\PriceCreateController;
use App\Http\Controllers\Prices\PriceUpdateController;
use App\Http\Controllers\Prices\PriceDeleteController;

use App\Http\Controllers\InterlinePriceController;
use App\Http\Controllers\InterlinePrices\InterlinePriceCreateController;
use App\Http\Controllers\InterlinePrices\InterlinePriceUpdateController;
use App\Http\Controllers\InterlinePrices\InterlinePriceDeleteController;

use App\Http\Controllers\TripController;
use App\Http\Controllers\Trips\TripCreateController;
use App\Http\Controllers\Trips\TripUpdateController;
use App\Http\Controllers\Trips\TripDeleteController;

use App\Http\Controllers\TravelScheduleController;
use App\Http\Controllers\TravelSchedules\TravelScheduleCreateController;
use App\Http\Controllers\TravelSchedules\TravelScheduleUpdateController;

use App\Http\Controllers\CellController;
use App\Http\Controllers\Cells\CellCreateController;
use App\Http\Controllers\Cells\CellUpdateController;
use App\Http\Controllers\Cells\CellDeleteController;

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

    Route::get('/agency', [CompanyController::class, 'index'])->name('company.index');
    Route::get('/agency/fetch', [CompanyController::class, 'fetch'])->name('company.fetch');
    Route::get('/agency/create', [CompanyController::class, 'create'])->name('company.create');
    Route::post('/agency/store', CompanyCreateController::class)->name('company.store');
    Route::get('/agency/show/{id}', [CompanyController::class, 'show'])->name('company.show');
    Route::post('/agency/update/{id}', CompanyUpdateController::class)->name('company.update');
    Route::post('/agency/destroy/{id}', CompanyDeleteController::class)->name('company.destroy');

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

    Route::get('/printer', [PrinterController::class, 'index'])->name('printer.index');
    Route::get('/printer/fetch', [PrinterController::class, 'fetch'])->name('printer.fetch');
    Route::get('/printer/create', [PrinterController::class, 'create'])->name('printer.create');
    Route::post('/printer/store', PrinterCreateController::class)->name('printer.store');
    Route::get('/printer/show/{id}', [PrinterController::class, 'show'])->name('printer.show');
    Route::post('/printer/update/{id}', PrinterUpdateController::class)->name('printer.update');
    Route::post('/printer/destroy/{id}', PrinterDeleteController::class)->name('printer.destroy');

    Route::get('/group-email', [GroupEmailController::class, 'index'])->name('group-email.index');
    Route::get('/group-email/fetch', [GroupEmailController::class, 'fetch'])->name('group-email.fetch');
    Route::get('/group-email/create', [GroupEmailController::class, 'create'])->name('group-email.create');
    Route::post('/group-email/store', GroupEmailCreateController::class)->name('group-email.store');
    Route::get('/group-email/show/{id}', [GroupEmailController::class, 'show'])->name('group-email.show');
    Route::post('/group-email/update/{id}', GroupEmailUpdateController::class)->name('group-email.update');
    Route::post('/group-email/destroy/{id}', GroupEmailDeleteController::class)->name('group-email.destroy');

    Route::get('/terminal', [TerminalController::class, 'index'])->name('terminal.index');
    Route::get('/terminal/fetch', [TerminalController::class, 'fetch'])->name('terminal.fetch');
    Route::get('/terminal/create', [TerminalController::class, 'create'])->name('terminal.create');
    Route::post('/terminal/store', TerminalCreateController::class)->name('terminal.store');
    Route::get('/terminal/show/{id}', [TerminalController::class, 'show'])->name('terminal.show');
    Route::post('/terminal/update/{id}', TerminalUpdateController::class)->name('terminal.update');
    Route::post('/terminal/destroy/{id}', TerminalDeleteController::class)->name('terminal.destroy');

    Route::get('/recommendation', [RecommendationController::class, 'index'])->name('recommendation.index');
    Route::get('/recommendation/fetch', [RecommendationController::class, 'fetch'])->name('recommendation.fetch');
    Route::get('/recommendation/create', [RecommendationController::class, 'create'])->name('recommendation.create');
    Route::post('/recommendation/store', RecommendationCreateController::class)->name('recommendation.store');
    Route::get('/recommendation/show/{id}', [RecommendationController::class, 'show'])->name('recommendation.show');
    Route::post('/recommendation/update/{id}', RecommendationUpdateController::class)->name('recommendation.update');
    Route::post('/recommendation/destroy/{id}', RecommendationDeleteController::class)->name('recommendation.destroy');

    Route::get('/option', function() {
        return view('pages.option.index');
    })->name('option.index');

    Route::get('/route', [RouteController::class, 'index'])->name('route.index');
    Route::get('/route/fetch', [RouteController::class, 'fetch'])->name('route.fetch');
    Route::get('/route/create', [RouteController::class, 'create'])->name('route.create');
    Route::post('/route/store', RouteCreateController::class)->name('route.store');
    Route::get('/route/show/{id}', [RouteController::class, 'show'])->name('route.show');
    Route::post('/route/update/{id}', RouteUpdateController::class)->name('route.update');
    Route::post('/route/destroy/{id}', RouteDeleteController::class)->name('route.destroy');

    Route::get('/multi-route', [MultiRouteController::class, 'index'])->name('multi-route.index');
    Route::get('/multi-route/fetch', [MultiRouteController::class, 'fetch'])->name('multi-route.fetch');
    Route::get('/multi-route/create', [MultiRouteController::class, 'create'])->name('multi-route.create');
    Route::post('/multi-route/store', MultiRouteCreateController::class)->name('multi-route.store');
    Route::get('/multi-route/show/{id}', [MultiRouteController::class, 'show'])->name('multi-route.show');
    Route::post('/multi-route/update/{id}', MultiRouteUpdateController::class)->name('multi-route.update');
    Route::post('/multi-route/destroy/{id}', MultiRouteDeleteController::class)->name('multi-route.destroy');

    Route::get('/price', [PriceController::class, 'index'])->name('price.index');
    Route::get('/price/fetch', [PriceController::class, 'fetch'])->name('price.fetch');
    Route::get('/price/create', [PriceController::class, 'create'])->name('price.create');
    Route::post('/price/store', PriceCreateController::class)->name('price.store');
    Route::get('/price/show/{id}', [PriceController::class, 'show'])->name('price.show');
    Route::post('/price/update/{id}', PriceUpdateController::class)->name('price.update');
    Route::post('/price/destroy/{id}', PriceDeleteController::class)->name('price.destroy');

    Route::get('/interline-price', [InterlinePriceController::class, 'index'])->name('interline-price.index');
    Route::get('/interline-price/fetch', [InterlinePriceController::class, 'fetch'])->name('interline-price.fetch');
    Route::get('/interline-price/create', [InterlinePriceController::class, 'create'])->name('interline-price.create');
    Route::post('/interline-price/store', InterlinePriceCreateController::class)->name('interline-price.store');
    Route::get('/interline-price/show/{id}', [InterlinePriceController::class, 'show'])->name('interline-price.show');
    Route::post('/interline-price/update/{id}', InterlinePriceUpdateController::class)->name('interline-price.update');
    Route::post('/interline-price/destroy/{id}', InterlinePriceDeleteController::class)->name('interline-price.destroy');

    Route::get('/trip', [TripController::class, 'index'])->name('trip.index');
    Route::get('/trip/fetch', [TripController::class, 'fetch'])->name('trip.fetch');
    Route::get('/trip/create', [TripController::class, 'create'])->name('trip.create');
    Route::post('/trip/store', TripCreateController::class)->name('trip.store');
    Route::get('/trip/show/{id}', [TripController::class, 'show'])->name('trip.show');
    Route::post('/trip/update/{id}', TripUpdateController::class)->name('trip.update');
    Route::post('/trip/destroy/{id}', TripDeleteController::class)->name('trip.destroy');

    Route::get('/travel-schedule/create', [TravelScheduleController::class, 'create'])->name('travel-schedule.create');
    Route::post('/travel-schedule/store', TravelScheduleCreateController::class)->name('travel-schedule.store');
    Route::get('/travel-schedule/show/{id}', [TravelScheduleController::class, 'show'])->name('travel-schedule.show');
    Route::post('/travel-schedule/update/{id}', TravelScheduleUpdateController::class)->name('travel-schedule.update');

    Route::get('/cell', [CellController::class, 'index'])->name('cell.index');
    Route::get('/cell/fetch', [CellController::class, 'fetch'])->name('cell.fetch');
    Route::get('/cell/create', [CellController::class, 'create'])->name('cell.create');
    Route::post('/cell/store', CellCreateController::class)->name('cell.store');
    Route::get('/cell/show/{id}', [CellController::class, 'show'])->name('cell.show');
    Route::post('/cell/update/{id}', CellUpdateController::class)->name('cell.update');
    Route::post('/cell/destroy/{id}', CellDeleteController::class)->name('cell.destroy');

});
