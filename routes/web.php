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
use App\Http\Controllers\Prices\PriceBatchUploadController;

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

use App\Http\Controllers\BusModelController;
use App\Http\Controllers\BusModels\BusModelCreateController;
use App\Http\Controllers\BusModels\BusModelUpdateController;
use App\Http\Controllers\BusModels\BusModelDeleteController;

use App\Http\Controllers\BusController;
use App\Http\Controllers\Buses\BusCreateController;
use App\Http\Controllers\Buses\BusUpdateController;
use App\Http\Controllers\Buses\BusDeleteController;

use App\Http\Controllers\TravelExpenseController;
use App\Http\Controllers\TravelExpenses\TravelExpenseCreateController;
use App\Http\Controllers\TravelExpenses\TravelExpenseUpdateController;
use App\Http\Controllers\TravelExpenses\TravelExpenseDeleteController;

use App\Http\Controllers\DailyItineraryController;

use App\Http\Controllers\ItineraryUpdateController;
use App\Http\Controllers\Observations\ObservationCreateController;

use App\Http\Controllers\BoardingManagementController;

use App\Http\Controllers\BaggageController;
use App\Http\Controllers\Baggages\BaggageCreateController;
use App\Http\Controllers\Baggages\BaggageUpdateController;
use App\Http\Controllers\Baggages\BaggageDeleteController;

use App\Http\Controllers\TicketSupportController;

use App\Http\Controllers\TicketController;
use App\Http\Controllers\Tickets\TicketCreateController;

use App\Http\Controllers\CityController;
use App\Http\Controllers\Cities\CityCreateController;
use App\Http\Controllers\Cities\CityBatchUploadController;
use App\Http\Controllers\Cities\CityUpdateController;
use App\Http\Controllers\Cities\CityDeleteController;

use App\Http\Controllers\VoucherController;
use App\Http\Controllers\Vouchers\VoucherCreateController;
use App\Http\Controllers\Vouchers\VoucherBatchUploadController;
use App\Http\Controllers\Vouchers\VoucherUpdateController;
use App\Http\Controllers\Vouchers\VoucherDeleteController;

use App\Http\Controllers\DiscountOptionController;
use App\Http\Controllers\DiscountOptions\DiscountOptionCreateController;
use App\Http\Controllers\DiscountOptions\DiscountOptionBatchUploadController;
use App\Http\Controllers\DiscountOptions\DiscountOptionUpdateController;
use App\Http\Controllers\DiscountOptions\DiscountOptionDeleteController;

use App\Http\Controllers\ExpenseIncomeController;
use App\Http\Controllers\ExpenseIncomes\ExpenseIncomeCreateController;
use App\Http\Controllers\ExpenseIncomes\ExpenseIncomeBatchUploadController;
use App\Http\Controllers\ExpenseIncomes\ExpenseIncomeUpdateController;
use App\Http\Controllers\ExpenseIncomes\ExpenseIncomeDeleteController;

use App\Http\Controllers\PromotionController;
use App\Http\Controllers\Promotions\PromotionCreateController;
use App\Http\Controllers\Promotions\PromotionBatchUploadController;
use App\Http\Controllers\Promotions\PromotionUpdateController;
use App\Http\Controllers\Promotions\PromotionDeleteController;

use App\Http\Controllers\CouponController;
use App\Http\Controllers\Coupons\CouponCreateController;
use App\Http\Controllers\Coupons\CouponBatchUploadController;
use App\Http\Controllers\Coupons\CouponUpdateController;
use App\Http\Controllers\Coupons\CouponDeleteController;

use App\Http\Controllers\DiscountController;
use App\Http\Controllers\Discounts\DiscountCreateController;
use App\Http\Controllers\Discounts\DiscountBatchUploadController;
use App\Http\Controllers\Discounts\DiscountUpdateController;
use App\Http\Controllers\Discounts\DiscountDeleteController;

use App\Http\Controllers\RouteAndMainDriverController;
use App\Http\Controllers\RouteAndMainDrivers\RouteAndMainDriverCreateController;
use App\Http\Controllers\RouteAndMainDrivers\RouteAndMainDriverBatchUploadController;
use App\Http\Controllers\RouteAndMainDrivers\RouteAndMainDriverUpdateController;
use App\Http\Controllers\RouteAndMainDrivers\RouteAndMainDriverDeleteController;

use App\Http\Controllers\PassengerController;

use App\Http\Controllers\OpenCashController;
use App\Http\Controllers\SeatTransferController;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\Reports\PrintController;

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

Route::get('/ticket/print/{id}/{passenger}/{arrival}/{departure}', [TicketController::class, 'printTicket'])->name('ticket.print');
Route::get('/ticket/scan-qr/{id}/{passenger}/{arrival}/{departure}', [TicketController::class, 'scanTicketQR'])->name('ticket.scan-qr');

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
    Route::get('/office/open-close', [OfficeController::class, 'openClose'])->name('office.open-close');
    Route::get('/office/open-close/update/{id}', [OfficeController::class, 'officeOpenClose'])->name('office.openclose.update');

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

    Route::get('/information', function() {
        return view('pages.support.information');
    })->name('information.index');

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
    Route::get('/price/upload',  [PriceController::class, 'upload'])->name('price.upload');
    Route::post('/price/batch/store', PriceBatchUploadController::class)->name('price.batch-store');

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

    Route::get('/bus-model', [BusModelController::class, 'index'])->name('bus-model.index');
    Route::get('/bus-model/fetch', [BusModelController::class, 'fetch'])->name('bus-model.fetch');
    Route::get('/bus-model/create', [BusModelController::class, 'create'])->name('bus-model.create');
    Route::post('/bus-model/store', BusModelCreateController::class)->name('bus-model.store');
    Route::get('/bus-model/show/{id}', [BusModelController::class, 'show'])->name('bus-model.show');
    Route::post('/bus-model/update/{id}', BusModelUpdateController::class)->name('bus-model.update');
    Route::post('/bus-model/destroy/{id}', BusModelDeleteController::class)->name('bus-model.destroy');

    Route::get('/bus', [BusController::class, 'index'])->name('bus.index');
    Route::get('/bus/fetch', [BusController::class, 'fetch'])->name('bus.fetch');
    Route::get('/bus/create', [BusController::class, 'create'])->name('bus.create');
    Route::post('/bus/store', BusCreateController::class)->name('bus.store');
    Route::get('/bus/show/{id}', [BusController::class, 'show'])->name('bus.show');
    Route::post('/bus/update/{id}', BusUpdateController::class)->name('bus.update');
    Route::post('/bus/destroy/{id}', BusDeleteController::class)->name('bus.destroy');

    Route::get('/travel-expense', [TravelExpenseController::class, 'index'])->name('travel-expense.index');
    Route::get('/travel-expense/fetch', [TravelExpenseController::class, 'fetch'])->name('travel-expense.fetch');
    Route::get('/travel-expense/create/{trip}', [TravelExpenseController::class, 'create'])->name('travel-expense.create');
    Route::post('/travel-expense/store', TravelExpenseCreateController::class)->name('travel-expense.store');
    Route::get('/travel-expense/show/{id}', [TravelExpenseController::class, 'show'])->name('travel-expense.show');
    Route::post('/travel-expense/update/{id}', TravelExpenseUpdateController::class)->name('travel-expense.update');

    Route::get('/daily-itinerary', [DailyItineraryController::class, 'index'])->name('daily-itinerary.index');
    Route::get('/daily-itinerary/fetch', [DailyItineraryController::class, 'fetch'])->name('daily-itinerary.fetch');

    Route::get('/itinerary-update', [ItineraryUpdateController::class, 'index'])->name('itinerary-update.index');
    Route::get('/itinerary-update/fetch', [ItineraryUpdateController::class, 'fetch'])->name('itinerary-update.fetch');
    Route::get('/itinerary-passenger/fetch/{id}', [ItineraryUpdateController::class, 'fetchPassenger'])->name('itinerary-passenger.fetch');
    Route::get('/itinerary-observation/fetch/{id}', [ItineraryUpdateController::class, 'fetchObservation'])->name('itinerary-observation.fetch');

    Route::post('/observation/store', ObservationCreateController::class)->name('observation.store');

    Route::get('/boarding', [BoardingManagementController::class, 'index'])->name('boarding.index');
    Route::get('/boarding/fetch', [BoardingManagementController::class, 'fetch'])->name('boarding.fetch');
    Route::post('/boarding/search/ticket', [BoardingManagementController::class, 'search'])->name('boarding-ticket.search');

    Route::get('/baggage', [BaggageController::class, 'index'])->name('baggage.index');
    Route::get('/baggage/fetch', [BaggageController::class, 'fetch'])->name('baggage.fetch');
    Route::get('/baggage/create', [BaggageController::class, 'create'])->name('baggage.create');
    Route::post('/baggage/store', BaggageCreateController::class)->name('baggage.store');
    Route::get('/baggage/show/{id}', [BaggageController::class, 'show'])->name('baggage.show');
    Route::post('/baggage/update/{id}', BaggageUpdateController::class)->name('baggage.update');
    Route::post('/baggage/destroy/{id}', BaggageDeleteController::class)->name('baggage.destroy');

    Route::get('/ticket-support', [TicketSupportController::class, 'index'])->name('ticket-support.index');
    Route::get('/ticket-support/fetch', [TicketSupportController::class, 'fetch'])->name('ticket-support.fetch');

    Route::get('/ticket', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/ticket/fetch', [TicketController::class, 'fetch'])->name('ticket.fetch');
    Route::post('/ticket/find/trip', [TicketController::class, 'findAvailableTrip'])->name('ticket.find-available-trip');
    Route::post('/ticket/get/bus', [TicketController::class, 'getBus'])->name('ticket.fetch-bus');
    Route::post('/ticket/get/passengers', [TicketController::class, 'getPassenger'])->name('ticket.fetch-passengers');
    Route::post('/ticket/store', TicketCreateController::class)->name('ticket.store');
    Route::post('/ticket/voucher/validate', [TicketController::class, 'voucherValidate'])->name('ticket.voucher-validate');

    Route::get('/city', [CityController::class, 'index'])->name('city.index');
    Route::get('/city/fetch', [CityController::class, 'fetch'])->name('city.fetch');
    Route::get('/city/create', [CityController::class, 'create'])->name('city.create');
    Route::get('/city/upload',  [CityController::class, 'upload'])->name('city.upload');
    Route::post('/city/store', CityCreateController::class)->name('city.store');
    Route::post('/city/batch/store', CityBatchUploadController::class)->name('city.batch-store');
    Route::get('/city/show/{id}', [CityController::class, 'show'])->name('city.show');
    Route::post('/city/update/{id}', CityUpdateController::class)->name('city.update');
    Route::post('/city/destroy/{id}', CityDeleteController::class)->name('city.destroy');

    Route::get('/voucher', [VoucherController::class, 'index'])->name('voucher.index');
    Route::get('/voucher/fetch', [VoucherController::class, 'fetch'])->name('voucher.fetch');
    Route::get('/voucher/create', [VoucherController::class, 'create'])->name('voucher.create');
    Route::post('/voucher/store', VoucherCreateController::class)->name('voucher.store');
    Route::get('/voucher/show/{id}', [VoucherController::class, 'show'])->name('voucher.show');
    Route::post('/voucher/update/{id}', VoucherUpdateController::class)->name('voucher.update');
    Route::post('/voucher/destroy/{id}', VoucherDeleteController::class)->name('voucher.destroy');

    Route::get('/discount-option', [DiscountOptionController::class, 'index'])->name('discount-option.index');
    Route::get('/discount-option/fetch', [DiscountOptionController::class, 'fetch'])->name('discount-option.fetch');
    Route::get('/discount-option/create', [DiscountOptionController::class, 'create'])->name('discount-option.create');
    Route::post('/discount-option/store', DiscountOptionCreateController::class)->name('discount-option.store');
    Route::get('/discount-option/show/{id}', [DiscountOptionController::class, 'show'])->name('discount-option.show');
    Route::post('/discount-option/update/{id}', DiscountOptionUpdateController::class)->name('discount-option.update');
    Route::post('/discount-option/destroy/{id}', DiscountOptionDeleteController::class)->name('discount-option.destroy');

    Route::get('/expense-income', [ExpenseIncomeController::class, 'index'])->name('expense-income.index');
    Route::get('/expense-income/fetch', [ExpenseIncomeController::class, 'fetch'])->name('expense-income.fetch');
    Route::get('/expense-income/create', [ExpenseIncomeController::class, 'create'])->name('expense-income.create');
    Route::post('/expense-income/store', ExpenseIncomeCreateController::class)->name('expense-income.store');
    Route::get('/expense-income/show/{id}', [ExpenseIncomeController::class, 'show'])->name('expense-income.show');
    Route::post('/expense-income/update/{id}', ExpenseIncomeUpdateController::class)->name('expense-income.update');
    Route::post('/expense-income/destroy/{id}', ExpenseIncomeDeleteController::class)->name('expense-income.destroy');

    Route::get('/frequent-traveler', [PassengerController::class, 'index'])->name('frequent-traveler.index');
    Route::get('/frequent-traveler/fetch', [PassengerController::class, 'fetch'])->name('frequent-traveler.fetch');

    Route::get('/promotion', [PromotionController::class, 'index'])->name('promotion.index');
    Route::get('/promotion/fetch', [PromotionController::class, 'fetch'])->name('promotion.fetch');
    Route::get('/promotion/create', [PromotionController::class, 'create'])->name('promotion.create');
    Route::post('/promotion/store', PromotionCreateController::class)->name('promotion.store');
    Route::get('/promotion/show/{id}', [PromotionController::class, 'show'])->name('promotion.show');
    Route::post('/promotion/update/{id}', PromotionUpdateController::class)->name('promotion.update');
    Route::post('/promotion/destroy/{id}', PromotionDeleteController::class)->name('promotion.destroy');

    Route::get('/coupon', [CouponController::class, 'index'])->name('coupon.index');
    Route::get('/coupon/fetch', [CouponController::class, 'fetch'])->name('coupon.fetch');
    Route::get('/coupon/create', [CouponController::class, 'create'])->name('coupon.create');
    Route::post('/coupon/store', CouponCreateController::class)->name('coupon.store');
    Route::get('/coupon/show/{id}', [CouponController::class, 'show'])->name('coupon.show');
    Route::post('/coupon/update/{id}', CouponUpdateController::class)->name('coupon.update');
    Route::post('/coupon/destroy/{id}', CouponDeleteController::class)->name('coupon.destroy');

    Route::get('/discount', [DiscountController::class, 'index'])->name('discount.index');
    Route::get('/discount/fetch', [DiscountController::class, 'fetch'])->name('discount.fetch');
    Route::get('/discount/create', [DiscountController::class, 'create'])->name('discount.create');
    Route::post('/discount/store', DiscountCreateController::class)->name('discount.store');
    Route::get('/discount/show/{id}', [DiscountController::class, 'show'])->name('discount.show');
    Route::post('/discount/update/{id}', DiscountUpdateController::class)->name('discount.update');
    Route::post('/discount/destroy/{id}', DiscountDeleteController::class)->name('discount.destroy');

    Route::get('/open-cash', [OpenCashController::class, 'index'])->name('open-cash.index');
    Route::post('/open-cash/store', [OpenCashController::class, 'addCash'])->name('open-cash.store');

    Route::get('/seat/transfer', [SeatTransferController::class, 'index'])->name('seat-transfer.index');
    Route::post('/fetch/origin/trip', [SeatTransferController::class, 'getTrip'])->name('seat-transfer.fetch-trip');
    Route::post('/seat/transfer/generate-bus', [SeatTransferController::class, 'getBus'])->name('seat-transfer.generate-bus');
    Route::post('/seat/transfer/update-bus', [SeatTransferController::class, 'update'])->name('seat-transfer.update');

    Route::get('/route-main-driver', [RouteAndMainDriverController::class, 'index'])->name('route-main-driver.index');
    Route::get('/route-main-driver/fetch', [RouteAndMainDriverController::class, 'fetch'])->name('route-main-driver.fetch');
    Route::get('/route-main-driver/create', [RouteAndMainDriverController::class, 'create'])->name('route-main-driver.create');
    Route::post('/route-main-driver/store', RouteAndMainDriverCreateController::class)->name('route-main-driver.store');
    Route::get('/route-main-driver/show/{id}', [RouteAndMainDriverController::class, 'show'])->name('route-main-driver.show');
    Route::post('/route-main-driver/update/{id}', RouteAndMainDriverUpdateController::class)->name('route-main-driver.update');
    Route::post('/route-main-driver/destroy/{id}', RouteAndMainDriverDeleteController::class)->name('route-main-driver.destroy');


    Route::get('/sales-by-user', [ReportController::class, 'salesByUser'])->name('sales-by-user');
    Route::get('/sales-by-user/print/{seller_ids?}/{date_type?}/{start_date?}/{end_date?}', [PrintController::class, 'printSalesByUser'])->name('sales-by-user.print');
    Route::get('/daily-till-closure', [ReportController::class, 'dailyTillClosure'])->name('daily-till-closure');
    Route::get('/daily-till-closure/print/{seller_ids?}/{date_type?}/{start_date?}/{end_date?}/{cash_register?}', [PrintController::class, 'printDailyTillClosure'])->name('daily-till-closure.print');
    Route::get('/daily-till-report-terminal', [ReportController::class, 'dailyTillReportTerminal'])->name('daily-till-report-terminal');
    Route::get('/daily-till-report-terminal/print/{office_id?}/{date_type?}/{start_date?}/{end_date?}/', [PrintController::class, 'printDailyTillReportTerminal'])->name('daily-till-report-terminal.print');
});
