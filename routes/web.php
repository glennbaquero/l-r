<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\Offices\{OfficeCreateController, OfficeUpdateController, OfficeDeleteController};
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\Currencies\{CurrencyCreateController, CurrencyUpdateController, CurrencyDeleteController};
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Companies\{CompanyCreateController, CompanyUpdateController, CompanyDeleteController};
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\TicketTypes\{TicketTypeCreateController, TicketTypeUpdateController, TicketTypeDeleteController};
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Services\{ServiceCreateController, ServiceUpdateController, ServiceDeleteController};
use App\Http\Controllers\UserController;
use App\Http\Controllers\Users\{UserCreateController, UserUpdateController, UserDeleteController};
use App\Http\Controllers\GroupController;
use App\Http\Controllers\Groups\{GroupCreateController, GroupUpdateController, GroupDeleteController};
use App\Http\Controllers\GroupPrivilegeController;
use App\Http\Controllers\GroupPrivileges\GroupPrivilegeUpdateController;
use App\Http\Controllers\GroupMessageController;
use App\Http\Controllers\GroupMessages\{GroupMessageCreateController, GroupMessageUpdateController, GroupMessageDeleteController};
use App\Http\Controllers\DriverController;
use App\Http\Controllers\Drivers\{DriverCreateController, DriverUpdateController, DriverDeleteController};
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\Printers\{PrinterCreateController, PrinterUpdateController, PrinterDeleteController};
use App\Http\Controllers\GroupEmailController;
use App\Http\Controllers\GroupEmails\{GroupEmailCreateController, GroupEmailUpdateController, GroupEmailDeleteController};
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\Terminals\{TerminalCreateController, TerminalUpdateController, TerminalDeleteController};
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\Recommendations\{RecommendationCreateController, RecommendationUpdateController, RecommendationDeleteController};
use App\Http\Controllers\RouteController;
use App\Http\Controllers\Routes\{RouteCreateController, RouteUpdateController, RouteDeleteController};
use App\Http\Controllers\MultiRouteController;
use App\Http\Controllers\MultiRoutes\{MultiRouteCreateController, MultiRouteUpdateController, MultiRouteDeleteController};
use App\Http\Controllers\PriceController;
use App\Http\Controllers\Prices\{PriceCreateController, PriceUpdateController, PriceDeleteController, PriceBatchUploadController};
use App\Http\Controllers\InterlinePriceController;
use App\Http\Controllers\InterlinePrices\{InterlinePriceCreateController, InterlinePriceUpdateController, InterlinePriceDeleteController};
use App\Http\Controllers\TripController;
use App\Http\Controllers\Trips\{TripCreateController, TripUpdateController, TripDeleteController};
use App\Http\Controllers\TravelScheduleController;
use App\Http\Controllers\TravelSchedules\{TravelScheduleCreateController, TravelScheduleUpdateController};
use App\Http\Controllers\CellController;
use App\Http\Controllers\Cells\{CellCreateController, CellUpdateController, CellDeleteController};
use App\Http\Controllers\BusModelController;
use App\Http\Controllers\BusModels\{BusModelCreateController, BusModelUpdateController, BusModelDeleteController};
use App\Http\Controllers\BusController;
use App\Http\Controllers\Buses\{BusCreateController, BusUpdateController, BusDeleteController};
use App\Http\Controllers\TravelExpenseController;
use App\Http\Controllers\TravelExpenses\{TravelExpenseCreateController, TravelExpenseUpdateController, TravelExpenseDeleteController};
use App\Http\Controllers\DailyItineraryController;
use App\Http\Controllers\ItineraryUpdateController;
use App\Http\Controllers\Observations\ObservationCreateController;
use App\Http\Controllers\BoardingManagementController;
use App\Http\Controllers\BaggageController;
use App\Http\Controllers\Baggages\{BaggageCreateController, BaggageUpdateController, BaggageDeleteController};
use App\Http\Controllers\TicketSupportController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Tickets\{TicketCreateController, TicketCancelController, TicketUpdateController};
use App\Http\Controllers\CityController;
use App\Http\Controllers\Cities\{CityCreateController, CityBatchUploadController, CityUpdateController, CityDeleteController};
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\Vouchers\{VoucherCreateController, VoucherBatchUploadController, VoucherUpdateController, VoucherDeleteController};
use App\Http\Controllers\DiscountOptionController;
use App\Http\Controllers\DiscountOptions\{DiscountOptionCreateController, DiscountOptionBatchUploadController, DiscountOptionUpdateController, DiscountOptionDeleteController};
use App\Http\Controllers\ExpenseIncomeController;
use App\Http\Controllers\ExpenseIncomes\{ExpenseIncomeCreateController, ExpenseIncomeBatchUploadController, ExpenseIncomeUpdateController, ExpenseIncomeDeleteController};
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\Promotions\{PromotionCreateController, PromotionBatchUploadController, PromotionUpdateController, PromotionDeleteController};
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Coupons\{CouponCreateController, CouponBatchUploadController, CouponUpdateController, CouponDeleteController};
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\Discounts\{DiscountCreateController, DiscountBatchUploadController, DiscountUpdateController, DiscountDeleteController};
use App\Http\Controllers\RouteAndMainDriverController;
use App\Http\Controllers\RouteAndMainDrivers\{RouteAndMainDriverCreateController, RouteAndMainDriverBatchUploadController, RouteAndMainDriverUpdateController, RouteAndMainDriverDeleteController};
use App\Http\Controllers\AccountPayableController;
use App\Http\Controllers\AccountPayables\{AccountPayableCreateController, AccountPayableBatchUploadController, AccountPayableUpdateController, AccountPayableDeleteController};
use App\Http\Controllers\AccountReceivableController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\OpenCashController;
use App\Http\Controllers\SeatTransferController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Reports\PrintController;
use App\Http\Controllers\PassengerReportController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::auth();

Route::get('/', fn() => redirect('/login'));

// Public Payment & Ticket Routes
Route::prefix('payment')->name('payment.')->group(function() {
    Route::get('/{id}/{passenger}/{arrival}/{departure}', [PaymentController::class, 'index'])->name('form');
    Route::post('/process/{id}/{passenger}/{arrival}/{departure}', [PaymentController::class, 'payment'])->name('process');
});

Route::prefix('ticket')->name('ticket.')->group(function() {
    Route::get('/print/{id}/{passenger}/{arrival}/{departure}/{preprocess?}', [TicketController::class, 'printTicket'])->name('print');
    Route::get('/confirmation/{id}/{passenger}/{arrival}/{departure}', [TicketController::class, 'ticketConfirmation'])->name('confirmation');
    Route::get('/verified', [TicketController::class, 'ticketVerified'])->name('verified');
    Route::post('/confirmed', [TicketController::class, 'confirmedTicket'])->name('confirmed');
    Route::get('/status/{ticket_status}/{id?}/{passenger?}/{arrival?}/{departure?}', [TicketController::class, 'ticketStatus'])->name('status');
});

Route::prefix('driver')->name('driver.')->group(function() {
    Route::get('/transaction-number', [TicketController::class, 'transactionNumberPage'])->name('transaction-number');
    Route::post('/transaction-number/validate', [TicketController::class, 'validateTransactionNumber'])->name('validate-transaction-number');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function() {
    
    // Dashboard & Scanner
    Route::get('/scanner', [DashboardController::class, 'scanQR'])->name('scanner');
    
    Route::prefix('driver')->name('driver.')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'driverDashboard'])->name('dashboard');
    });

    Route::post('/locale', LocaleController::class)->name('locale');

    Route::prefix('dashboard')->name('dashboard')->group(function() {
        Route::get('/', [DashboardController::class, 'index']);
        Route::post('/line', [DashboardController::class, 'updateLineGraph'])->name('.update-line-graph');
    });
    
    Route::post('/user/office/update', [DashboardController::class, 'update'])->name('user-office.update');

    // Notifications
    Route::prefix('notify')->name('notify.')->group(function() {
        Route::post('/users', [NotificationController::class, 'notification'])->name('users');
    });
    
    Route::prefix('notification')->name('notification.')->group(function() {
        Route::post('/read', [NotificationController::class, 'notificationRead'])->name('read');
        Route::post('/reply/{id}', [NotificationController::class, 'replyToNotification'])->name('reply');
    });

    // Office Routes
    Route::prefix('office')->name('office.')->group(function() {
        Route::get('/', [OfficeController::class, 'index'])->name('index');
        Route::get('/fetch', [OfficeController::class, 'fetch'])->name('fetch');
        Route::get('/create', [OfficeController::class, 'create'])->name('create');
        Route::post('/store', OfficeCreateController::class)->name('store');
        Route::get('/show/{id}', [OfficeController::class, 'show'])->name('show');
        Route::post('/update/{id}', OfficeUpdateController::class)->name('update');
        Route::post('/destroy/{id}', OfficeDeleteController::class)->name('destroy');
        Route::get('/open-close', [OfficeController::class, 'openClose'])->name('open-close');
        Route::get('/open-close/update/{id}', [OfficeController::class, 'officeOpenClose'])->name('openclose.update');
    });

    // Currency Routes
    Route::prefix('currency')->name('currency.')->group(function() {
        Route::get('/', [CurrencyController::class, 'index'])->name('index');
        Route::get('/fetch', [CurrencyController::class, 'fetch'])->name('fetch');
        Route::get('/create', [CurrencyController::class, 'create'])->name('create');
        Route::post('/store', CurrencyCreateController::class)->name('store');
        Route::get('/show/{id}', [CurrencyController::class, 'show'])->name('show');
        Route::post('/update/{id}', CurrencyUpdateController::class)->name('update');
        Route::post('/destroy/{id}', CurrencyDeleteController::class)->name('destroy');
    });

    // Ticket Type Routes
    Route::prefix('ticket-type')->name('ticket-type.')->group(function() {
        Route::get('/', [TicketTypeController::class, 'index'])->name('index');
        Route::get('/fetch', [TicketTypeController::class, 'fetch'])->name('fetch');
        Route::get('/create', [TicketTypeController::class, 'create'])->name('create');
        Route::post('/store', TicketTypeCreateController::class)->name('store');
        Route::get('/show/{id}', [TicketTypeController::class, 'show'])->name('show');
        Route::post('/update/{id}', TicketTypeUpdateController::class)->name('update');
        Route::post('/destroy/{id}', TicketTypeDeleteController::class)->name('destroy');
    });

    // Agency (Company) Routes
    Route::prefix('agency')->name('company.')->group(function() {
        Route::get('/', [CompanyController::class, 'index'])->name('index');
        Route::get('/fetch', [CompanyController::class, 'fetch'])->name('fetch');
        Route::get('/create', [CompanyController::class, 'create'])->name('create');
        Route::post('/store', CompanyCreateController::class)->name('store');
        Route::get('/show/{id}', [CompanyController::class, 'show'])->name('show');
        Route::post('/update/{id}', CompanyUpdateController::class)->name('update');
        Route::post('/destroy/{id}', CompanyDeleteController::class)->name('destroy');
    });

    // User Routes
    Route::prefix('user')->name('user.')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/fetch', [UserController::class, 'fetch'])->name('fetch');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', UserCreateController::class)->name('store');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('show');
        Route::post('/update/{id}', UserUpdateController::class)->name('update');
        Route::post('/destroy/{id}', UserDeleteController::class)->name('destroy');
    });

    // Group Routes
    Route::prefix('group')->name('group.')->group(function() {
        Route::get('/', [GroupController::class, 'index'])->name('index');
        Route::get('/fetch', [GroupController::class, 'fetch'])->name('fetch');
        Route::get('/create', [GroupController::class, 'create'])->name('create');
        Route::post('/store', GroupCreateController::class)->name('store');
        Route::get('/show/{id}', [GroupController::class, 'show'])->name('show');
        Route::post('/update/{id}', GroupUpdateController::class)->name('update');
        Route::post('/destroy/{id}', GroupDeleteController::class)->name('destroy');
    });

    // Group Privilege Routes
    Route::prefix('group-privilege')->name('group-privilege.')->group(function() {
        Route::get('/', [GroupPrivilegeController::class, 'index'])->name('index');
        Route::get('/fetch', [GroupPrivilegeController::class, 'fetch'])->name('fetch');
        Route::post('/update/{groupId}/{groupPrivilegeid}', GroupPrivilegeUpdateController::class)->name('update');
    });

    // Group Message Routes
    Route::prefix('group-message')->name('group-message.')->group(function() {
        Route::get('/', [GroupMessageController::class, 'index'])->name('index');
        Route::get('/fetch', [GroupMessageController::class, 'fetch'])->name('fetch');
        Route::get('/create', [GroupMessageController::class, 'create'])->name('create');
        Route::post('/store', GroupMessageCreateController::class)->name('store');
        Route::get('/show/{id}', [GroupMessageController::class, 'show'])->name('show');
        Route::post('/update/{id}', GroupMessageUpdateController::class)->name('update');
        Route::post('/destroy/{id}', GroupMessageDeleteController::class)->name('destroy');
    });

    // Service Routes
    Route::prefix('service')->name('service.')->group(function() {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/fetch', [ServiceController::class, 'fetch'])->name('fetch');
        Route::get('/create', [ServiceController::class, 'create'])->name('create');
        Route::post('/store', ServiceCreateController::class)->name('store');
        Route::get('/show/{id}', [ServiceController::class, 'show'])->name('show');
        Route::post('/update/{id}', ServiceUpdateController::class)->name('update');
        Route::post('/destroy/{id}', ServiceDeleteController::class)->name('destroy');
    });

    // Driver Routes (authenticated)
    Route::prefix('driver')->name('driver.')->group(function() {
        Route::get('/', [DriverController::class, 'index'])->name('index');
        Route::get('/fetch', [DriverController::class, 'fetch'])->name('fetch');
        Route::get('/create', [DriverController::class, 'create'])->name('create');
        Route::post('/store', DriverCreateController::class)->name('store');
        Route::get('/show/{id}', [DriverController::class, 'show'])->name('show');
        Route::post('/update/{id}', DriverUpdateController::class)->name('update');
        Route::post('/destroy/{id}', DriverDeleteController::class)->name('destroy');
    });

    // Printer Routes
    Route::prefix('printer')->name('printer.')->group(function() {
        Route::get('/', [PrinterController::class, 'index'])->name('index');
        Route::get('/fetch', [PrinterController::class, 'fetch'])->name('fetch');
        Route::get('/create', [PrinterController::class, 'create'])->name('create');
        Route::post('/store', PrinterCreateController::class)->name('store');
        Route::get('/show/{id}', [PrinterController::class, 'show'])->name('show');
        Route::post('/update/{id}', PrinterUpdateController::class)->name('update');
        Route::post('/destroy/{id}', PrinterDeleteController::class)->name('destroy');
    });

    // Group Email Routes
    Route::prefix('group-email')->name('group-email.')->group(function() {
        Route::get('/', [GroupEmailController::class, 'index'])->name('index');
        Route::get('/fetch', [GroupEmailController::class, 'fetch'])->name('fetch');
        Route::get('/create', [GroupEmailController::class, 'create'])->name('create');
        Route::post('/store', GroupEmailCreateController::class)->name('store');
        Route::get('/show/{id}', [GroupEmailController::class, 'show'])->name('show');
        Route::post('/update/{id}', GroupEmailUpdateController::class)->name('update');
        Route::post('/destroy/{id}', GroupEmailDeleteController::class)->name('destroy');
    });

    // Terminal Routes
    Route::prefix('terminal')->name('terminal.')->group(function() {
        Route::get('/', [TerminalController::class, 'index'])->name('index');
        Route::get('/fetch', [TerminalController::class, 'fetch'])->name('fetch');
        Route::get('/create', [TerminalController::class, 'create'])->name('create');
        Route::post('/store', TerminalCreateController::class)->name('store');
        Route::get('/show/{id}', [TerminalController::class, 'show'])->name('show');
        Route::post('/update/{id}', TerminalUpdateController::class)->name('update');
        Route::post('/destroy/{id}', TerminalDeleteController::class)->name('destroy');
    });

    // Recommendation Routes
    Route::prefix('recommendation')->name('recommendation.')->group(function() {
        Route::get('/', [RecommendationController::class, 'index'])->name('index');
        Route::get('/fetch', [RecommendationController::class, 'fetch'])->name('fetch');
        Route::get('/create', [RecommendationController::class, 'create'])->name('create');
        Route::post('/store', RecommendationCreateController::class)->name('store');
        Route::get('/show/{id}', [RecommendationController::class, 'show'])->name('show');
        Route::post('/update/{id}', RecommendationUpdateController::class)->name('update');
        Route::post('/destroy/{id}', RecommendationDeleteController::class)->name('destroy');
    });

    // Option & Information
    Route::get('/option', fn() => view('pages.option.index'))->name('option.index');
    Route::get('/information', fn() => view('pages.support.information'))->name('information.index');

    // Route Routes
    Route::prefix('route')->name('route.')->group(function() {
        Route::get('/', [RouteController::class, 'index'])->name('index');
        Route::get('/fetch', [RouteController::class, 'fetch'])->name('fetch');
        Route::get('/create', [RouteController::class, 'create'])->name('create');
        Route::post('/store', RouteCreateController::class)->name('store');
        Route::get('/show/{id}', [RouteController::class, 'show'])->name('show');
        Route::post('/copy-reverse/{id}', [RouteController::class, 'copyReverse'])->name('copy-reverse');
        Route::post('/update/{id}', RouteUpdateController::class)->name('update');
        Route::post('/destroy/{id}', RouteDeleteController::class)->name('destroy');
    });

    // Multi Route Routes
    Route::prefix('multi-route')->name('multi-route.')->group(function() {
        Route::get('/', [MultiRouteController::class, 'index'])->name('index');
        Route::get('/fetch', [MultiRouteController::class, 'fetch'])->name('fetch');
        Route::get('/create', [MultiRouteController::class, 'create'])->name('create');
        Route::post('/store', MultiRouteCreateController::class)->name('store');
        Route::get('/show/{id}', [MultiRouteController::class, 'show'])->name('show');
        Route::post('/update/{id}', MultiRouteUpdateController::class)->name('update');
        Route::post('/destroy/{id}', MultiRouteDeleteController::class)->name('destroy');
    });

    // Price Routes
    Route::prefix('price')->name('price.')->group(function() {
        Route::get('/', [PriceController::class, 'index'])->name('index');
        Route::get('/fetch', [PriceController::class, 'fetch'])->name('fetch');
        Route::get('/create', [PriceController::class, 'create'])->name('create');
        Route::post('/store', PriceCreateController::class)->name('store');
        Route::get('/show/{id}', [PriceController::class, 'show'])->name('show');
        Route::post('/duplicate/{id}', [PriceController::class, 'duplicate'])->name('duplicate');
        Route::post('/update/{id}', PriceUpdateController::class)->name('update');
        Route::post('/destroy/{id}', PriceDeleteController::class)->name('destroy');
        Route::get('/upload', [PriceController::class, 'upload'])->name('upload');
        Route::post('/copy', [PriceController::class, 'copyPrice'])->name('copy-price');
        Route::post('/batch/store', PriceBatchUploadController::class)->name('batch-store');
    });

    // Interline Price Routes
    Route::prefix('interline-price')->name('interline-price.')->group(function() {
        Route::get('/', [InterlinePriceController::class, 'index'])->name('index');
        Route::get('/fetch', [InterlinePriceController::class, 'fetch'])->name('fetch');
        Route::get('/create', [InterlinePriceController::class, 'create'])->name('create');
        Route::post('/store', InterlinePriceCreateController::class)->name('store');
        Route::get('/show/{id}', [InterlinePriceController::class, 'show'])->name('show');
        Route::post('/update/{id}', InterlinePriceUpdateController::class)->name('update');
        Route::post('/destroy/{id}', InterlinePriceDeleteController::class)->name('destroy');
    });

    // Trip Routes
    Route::prefix('trip')->name('trip.')->group(function() {
        Route::get('/', [TripController::class, 'index'])->name('index');
        Route::get('/fetch', [TripController::class, 'fetch'])->name('fetch');
        Route::get('/create', [TripController::class, 'create'])->name('create');
        Route::get('/time/destroy/{id}', [TripController::class, 'deleteTime'])->name('time.destroy');
        Route::post('/store', TripCreateController::class)->name('store');
        Route::get('/show/{id}', [TripController::class, 'show'])->name('show');
        Route::post('/update/{id}', TripUpdateController::class)->name('update');
        Route::post('/destroy/{id}', TripDeleteController::class)->name('destroy');
    });

    // Travel Schedule Routes
    Route::prefix('travel-schedule')->name('travel-schedule.')->group(function() {
        Route::get('/create', [TravelScheduleController::class, 'create'])->name('create');
        Route::post('/store', TravelScheduleCreateController::class)->name('store');
        Route::get('/show/{id}', [TravelScheduleController::class, 'show'])->name('show');
        Route::post('/update/{id}', TravelScheduleUpdateController::class)->name('update');
    });

    // Cell Routes
    Route::prefix('cell')->name('cell.')->group(function() {
        Route::get('/', [CellController::class, 'index'])->name('index');
        Route::get('/fetch', [CellController::class, 'fetch'])->name('fetch');
        Route::get('/create', [CellController::class, 'create'])->name('create');
        Route::post('/store', CellCreateController::class)->name('store');
        Route::get('/show/{id}', [CellController::class, 'show'])->name('show');
        Route::post('/update/{id}', CellUpdateController::class)->name('update');
        Route::post('/destroy/{id}', CellDeleteController::class)->name('destroy');
    });

    // Bus Model Routes
    Route::prefix('bus-model')->name('bus-model.')->group(function() {
        Route::get('/', [BusModelController::class, 'index'])->name('index');
        Route::get('/fetch', [BusModelController::class, 'fetch'])->name('fetch');
        Route::get('/create', [BusModelController::class, 'create'])->name('create');
        Route::post('/store', BusModelCreateController::class)->name('store');
        Route::get('/show/{id}', [BusModelController::class, 'show'])->name('show');
        Route::post('/update/{id}', BusModelUpdateController::class)->name('update');
        Route::post('/destroy/{id}', BusModelDeleteController::class)->name('destroy');
    });

    // Bus Routes
    Route::prefix('bus')->name('bus.')->group(function() {
        Route::get('/', [BusController::class, 'index'])->name('index');
        Route::get('/fetch', [BusController::class, 'fetch'])->name('fetch');
        Route::get('/create', [BusController::class, 'create'])->name('create');
        Route::post('/store', BusCreateController::class)->name('store');
        Route::get('/show/{id}', [BusController::class, 'show'])->name('show');
        Route::post('/update/{id}', BusUpdateController::class)->name('update');
        Route::post('/destroy/{id}', BusDeleteController::class)->name('destroy');
    });

    // Travel Expense Routes
    Route::prefix('travel-expense')->name('travel-expense.')->group(function() {
        Route::get('/', [TravelExpenseController::class, 'index'])->name('index');
        Route::get('/fetch', [TravelExpenseController::class, 'fetch'])->name('fetch');
        Route::get('/create/{trip}', [TravelExpenseController::class, 'create'])->name('create');
        Route::post('/store', TravelExpenseCreateController::class)->name('store');
        Route::get('/show/{id}', [TravelExpenseController::class, 'show'])->name('show');
        Route::post('/update/{id}', TravelExpenseUpdateController::class)->name('update');
    });

    // Daily Itinerary Routes
    Route::prefix('daily-itinerary')->name('daily-itinerary.')->group(function() {
        Route::get('/', [DailyItineraryController::class, 'index'])->name('index');
        Route::get('/fetch', [DailyItineraryController::class, 'fetch'])->name('fetch');
    });

    // Itinerary Update Routes
    Route::prefix('itinerary-update')->name('itinerary-update.')->group(function() {
        Route::get('/', [ItineraryUpdateController::class, 'index'])->name('index');
        Route::get('/fetch', [ItineraryUpdateController::class, 'fetch'])->name('fetch');
    });
    
    Route::get('/itinerary-passenger/fetch/{id}', [ItineraryUpdateController::class, 'fetchPassenger'])->name('itinerary-passenger.fetch');
    Route::get('/itinerary-observation/fetch/{id}', [ItineraryUpdateController::class, 'fetchObservation'])->name('itinerary-observation.fetch');

    // Observation Routes
    Route::post('/observation/store', ObservationCreateController::class)->name('observation.store');

    // Boarding Routes
    Route::prefix('boarding')->name('boarding.')->group(function() {
        Route::get('/', [BoardingManagementController::class, 'index'])->name('index');
        Route::get('/fetch', [BoardingManagementController::class, 'fetch'])->name('fetch');
        Route::post('/search/ticket', [BoardingManagementController::class, 'search'])->name('ticket.search');
    });

    // Baggage Routes
    Route::prefix('baggage')->name('baggage.')->group(function() {
        Route::get('/', [BaggageController::class, 'index'])->name('index');
        Route::get('/fetch', [BaggageController::class, 'fetch'])->name('fetch');
        Route::get('/create', [BaggageController::class, 'create'])->name('create');
        Route::post('/store', BaggageCreateController::class)->name('store');
        Route::get('/show/{id}', [BaggageController::class, 'show'])->name('show');
        Route::post('/update/{id}', BaggageUpdateController::class)->name('update');
        Route::post('/destroy/{id}', BaggageDeleteController::class)->name('destroy');
    });

    // Ticket Support Routes
    Route::prefix('ticket-support')->name('ticket-support.')->group(function() {
        Route::get('/', [TicketSupportController::class, 'index'])->name('index');
        Route::get('/fetch', [TicketSupportController::class, 'fetch'])->name('fetch');
    });

    // Ticket Routes (authenticated)
    Route::prefix('ticket')->name('ticket.')->group(function() {
        Route::get('/', [TicketController::class, 'index'])->name('index');
        Route::get('/fetch/{office_id?}/{office_view?}', [TicketController::class, 'fetch'])->name('fetch');
        Route::get('/preprocess/fetch/{office_id?}/{office_view?}', [TicketController::class, 'fetchPreprocessTicket'])->name('preprocess.fetch');
        Route::post('/find/trip', [TicketController::class, 'findAvailableTrip'])->name('find-available-trip');
        Route::post('/get/trip/time', [TicketController::class, 'getTripTime'])->name('get-trip-time');
        Route::post('/get/bus', [TicketController::class, 'getBus'])->name('fetch-bus');
        Route::post('/get-available-bus', [TicketController::class, 'getAvailableBus'])->name('get-available-bus');
        Route::post('/get/passengers', [TicketController::class, 'getPassenger'])->name('fetch-passengers');
        Route::post('/voucher/validate', [TicketController::class, 'couponValidate'])->name('voucher-validate');
        Route::post('/store', TicketCreateController::class)->name('store');
        Route::get('/cancel/{id}', TicketCancelController::class)->name('cancel');
        Route::post('/update/{id}', TicketUpdateController::class)->name('update');
        Route::post('/email/{id}', [TicketController::class, 'passengerEmailSender'])->name('send-email');
        Route::post('/register-payment', [TicketController::class, 'registerPayment'])->name('register-payment');
        Route::post('/paid/notify/passenger', [TicketController::class, 'notifyPassenger'])->name('paid.notify-passenger');
        Route::get('/scan-qr/{id}/{passenger}/{arrival}/{departure}', [TicketController::class, 'scanTicketQR'])->name('scan-qr');
    });

    // City Routes
    Route::prefix('city')->name('city.')->group(function() {
        Route::get('/', [CityController::class, 'index'])->name('index');
        Route::get('/fetch', [CityController::class, 'fetch'])->name('fetch');
        Route::get('/create', [CityController::class, 'create'])->name('create');
        Route::get('/upload', [CityController::class, 'upload'])->name('upload');
        Route::post('/store', CityCreateController::class)->name('store');
        Route::post('/batch/store', CityBatchUploadController::class)->name('batch-store');
        Route::get('/show/{id}', [CityController::class, 'show'])->name('show');
        Route::post('/update/{id}', CityUpdateController::class)->name('update');
        Route::post('/destroy/{id}', CityDeleteController::class)->name('destroy');
    });

    // Voucher Routes
    Route::prefix('voucher')->name('voucher.')->group(function() {
        Route::get('/', [VoucherController::class, 'index'])->name('index');
        Route::get('/fetch', [VoucherController::class, 'fetch'])->name('fetch');
        Route::get('/create', [VoucherController::class, 'create'])->name('create');
        Route::post('/store', VoucherCreateController::class)->name('store');
        Route::get('/show/{id}', [VoucherController::class, 'show'])->name('show');
        Route::post('/update/{id}', VoucherUpdateController::class)->name('update');
        Route::post('/destroy/{id}', VoucherDeleteController::class)->name('destroy');
    });

    // Discount Option Routes
    Route::prefix('discount-option')->name('discount-option.')->group(function() {
        Route::get('/', [DiscountOptionController::class, 'index'])->name('index');
        Route::get('/fetch', [DiscountOptionController::class, 'fetch'])->name('fetch');
        Route::get('/create', [DiscountOptionController::class, 'create'])->name('create');
        Route::post('/store', DiscountOptionCreateController::class)->name('store');
        Route::get('/show/{id}', [DiscountOptionController::class, 'show'])->name('show');
        Route::post('/update/{id}', DiscountOptionUpdateController::class)->name('update');
        Route::post('/destroy/{id}', DiscountOptionDeleteController::class)->name('destroy');
    });

    // Expense Income Routes
    Route::prefix('expense-income')->name('expense-income.')->group(function() {
        Route::get('/', [ExpenseIncomeController::class, 'index'])->name('index');
        Route::get('/fetch', [ExpenseIncomeController::class, 'fetch'])->name('fetch');
        Route::get('/create', [ExpenseIncomeController::class, 'create'])->name('create');
        Route::post('/store', ExpenseIncomeCreateController::class)->name('store');
        Route::get('/show/{id}', [ExpenseIncomeController::class, 'show'])->name('show');
        Route::post('/update/{id}', ExpenseIncomeUpdateController::class)->name('update');
        Route::post('/destroy/{id}', ExpenseIncomeDeleteController::class)->name('destroy');
    });

    // Frequent Traveler (Passenger) Routes
    Route::prefix('frequent-traveler')->name('frequent-traveler.')->group(function() {
        Route::get('/', [PassengerController::class, 'index'])->name('index');
        Route::get('/fetch', [PassengerController::class, 'fetch'])->name('fetch');
    });

    // Promotion Routes
    Route::prefix('promotion')->name('promotion.')->group(function() {
        Route::get('/', [PromotionController::class, 'index'])->name('index');
        Route::get('/fetch', [PromotionController::class, 'fetch'])->name('fetch');
        Route::get('/create', [PromotionController::class, 'create'])->name('create');
        Route::post('/store', PromotionCreateController::class)->name('store');
        Route::get('/show/{id}', [PromotionController::class, 'show'])->name('show');
        Route::post('/update/{id}', PromotionUpdateController::class)->name('update');
        Route::post('/destroy/{id}', PromotionDeleteController::class)->name('destroy');
    });

    // Coupon Routes
    Route::prefix('coupon')->name('coupon.')->group(function() {
        Route::get('/', [CouponController::class, 'index'])->name('index');
        Route::get('/fetch', [CouponController::class, 'fetch'])->name('fetch');
        Route::get('/create', [CouponController::class, 'create'])->name('create');
        Route::post('/store', CouponCreateController::class)->name('store');
        Route::get('/show/{id}', [CouponController::class, 'show'])->name('show');
        Route::post('/update/{id}', CouponUpdateController::class)->name('update');
        Route::post('/destroy/{id}', CouponDeleteController::class)->name('destroy');
    });

    // Discount Routes
    Route::prefix('discount')->name('discount.')->group(function() {
        Route::get('/', [DiscountController::class, 'index'])->name('index');
        Route::get('/fetch', [DiscountController::class, 'fetch'])->name('fetch');
        Route::get('/create', [DiscountController::class, 'create'])->name('create');
        Route::post('/store', DiscountCreateController::class)->name('store');
        Route::get('/show/{id}', [DiscountController::class, 'show'])->name('show');
        Route::post('/update/{id}', DiscountUpdateController::class)->name('update');
        Route::post('/destroy/{id}', DiscountDeleteController::class)->name('destroy');
    });

    // Open Cash Routes
    Route::prefix('open-cash')->name('open-cash.')->group(function() {
        Route::get('/', [OpenCashController::class, 'index'])->name('index');
        Route::post('/store', [OpenCashController::class, 'addCash'])->name('store');
        Route::get('/fetch', [OpenCashController::class, 'fetch'])->name('fetch');
    });

    // Seat Transfer Routes
    Route::prefix('seat')->name('seat-transfer.')->group(function() {
        Route::get('/transfer', [SeatTransferController::class, 'index'])->name('index');
        Route::post('/transfer/fetch/origin/trip', [SeatTransferController::class, 'getTrip'])->name('fetch-trip');
        Route::post('/transfer/generate-bus', [SeatTransferController::class, 'getBus'])->name('generate-bus');
        Route::post('/transfer/update-bus', [SeatTransferController::class, 'update'])->name('update');
    });

    // Route Main Driver Routes
    Route::prefix('route-main-driver')->name('route-main-driver.')->group(function() {
        Route::get('/', [RouteAndMainDriverController::class, 'index'])->name('index');
        Route::get('/fetch', [RouteAndMainDriverController::class, 'fetch'])->name('fetch');
        Route::get('/create', [RouteAndMainDriverController::class, 'create'])->name('create');
        Route::post('/store', RouteAndMainDriverCreateController::class)->name('store');
        Route::get('/show/{id}', [RouteAndMainDriverController::class, 'show'])->name('show');
        Route::post('/update/{id}', RouteAndMainDriverUpdateController::class)->name('update');
        Route::post('/destroy/{id}', RouteAndMainDriverDeleteController::class)->name('destroy');
    });

    // Account Payable Routes
    Route::prefix('account-payable')->name('account-payable.')->group(function() {
        Route::get('/', [AccountPayableController::class, 'index'])->name('index');
        Route::get('/fetch', [AccountPayableController::class, 'fetch'])->name('fetch');
        Route::get('/create', [AccountPayableController::class, 'create'])->name('create');
        Route::post('/store', AccountPayableCreateController::class)->name('store');
        Route::get('/show/{id}', [AccountPayableController::class, 'show'])->name('show');
        Route::post('/update/{id}', AccountPayableUpdateController::class)->name('update');
        Route::post('/destroy/{id}', AccountPayableDeleteController::class)->name('destroy');
    });

    // Account Receivable Routes
    Route::get('/account-receivable', [AccountReceivableController::class, 'index'])->name('account-receivable.index');

    // Passenger Report Routes
    Route::prefix('passenger-report')->name('passenger-report.')->group(function() {
        Route::get('/', [PassengerReportController::class, 'index'])->name('index');
        Route::get('/fetch', [PassengerReportController::class, 'fetch'])->name('fetch');
        Route::get('/total/fetch/{id}/{type}', [PassengerReportController::class, 'fetchPassenger'])->name('total.fetch');
    });

    // Sales & Report Routes
    Route::prefix('sales-by-user')->name('sales-by-user')->group(function() {
        Route::get('/', [ReportController::class, 'salesByUser']);
        Route::get('/print/{seller_ids?}/{date_type?}/{start_date?}/{end_date?}', [PrintController::class, 'printSalesByUser'])->name('.print');
    });

    Route::prefix('daily-till-closure')->name('daily-till-closure')->group(function() {
        Route::get('/', [ReportController::class, 'dailyTillClosure']);
        Route::get('/print/{seller_ids?}/{date_type?}/{start_date?}/{end_date?}/{cash_register?}', [PrintController::class, 'printDailyTillClosure'])->name('.print');
    });

    Route::prefix('daily-till-report-terminal')->name('daily-till-report-terminal')->group(function() {
        Route::get('/', [ReportController::class, 'dailyTillReportTerminal']);
        Route::get('/print/{office_id?}/{date_type?}/{start_date?}/{end_date?}/', [PrintController::class, 'printDailyTillReportTerminal'])->name('.print');
    });

    Route::prefix('my-daily-closure')->name('my-daily-closure')->group(function() {
        Route::get('/', [ReportController::class, 'myDailyClosure']);
        Route::get('/print/{date_type?}/{start_date?}/{end_date?}/{cash_register?}', [PrintController::class, 'printMyDailyTillClosure'])->name('.print');
    });

    Route::prefix('reservation-per-route')->name('reservation-per-route')->group(function() {
        Route::get('/', [ReportController::class, 'reservationPerRoute']);
        Route::get('/print/{date_type?}/{start_date?}/{end_date?}/{trip_ids?}', [PrintController::class, 'printReservationPerRoute'])->name('.print');
    });

    Route::prefix('price-per-route')->name('price-per-route')->group(function() {
        Route::get('/', [ReportController::class, 'pricePerRoute']);
        Route::get('/print/{city_id?}/{type_ids?}', [PrintController::class, 'printPricePerRoute'])->name('.print');
    });

    Route::prefix('income-by-route')->name('income-by-route')->group(function() {
        Route::get('/', [ReportController::class, 'incomeByRoute']);
        Route::get('/print/{route_ids?}/{bus_ids?}/{service_ids?}/{date_type?}/{start_date?}/{end_date?}', [PrintController::class, 'printIncomeByRoute'])->name('.print');
    });

    Route::prefix('sales-by-departure-arrival')->name('sales-by-departure-arrival')->group(function() {
        Route::get('/', [ReportController::class, 'salesByDepartureArrival']);
        Route::get('/print/{departure_ids?}/{arrival_ids?}/{type_ids?}/{genders?}/{date_type?}/{start_date?}/{end_date?}', [PrintController::class, 'printSalesByDepartureArrival'])->name('.print');
    });

    Route::prefix('sales-by-travel')->name('sales-by-travel')->group(function() {
        Route::get('/', [ReportController::class, 'salesByTravel']);
        Route::get('/print/{trip_ids?}/{terminal_ids?}/{service_ids?}/{date_type?}/{start_date?}/{end_date?}', [PrintController::class, 'printSalesByTravel'])->name('.print');
    });

    Route::prefix('sales-by-voucher')->name('sales-by-voucher')->group(function() {
        Route::get('/', [ReportController::class, 'salesByVoucher']);
        Route::get('/print/{is_open?}', [PrintController::class, 'printSalesByVoucher'])->name('.print');
    });

    Route::prefix('sales-by-ticket')->name('sales-by-ticket')->group(function() {
        Route::get('/', [ReportController::class, 'salesByTicket']);
        Route::get('/print/{office_ids?}/{user_ids?}/{ticket_type_ids?}/{ticket_status?}/{payment_type?}/{date_type?}/{start_date?}/{end_date?}', [PrintController::class, 'printSalesByTicket'])->name('.print');
    });

    Route::prefix('sales-by-credit-card')->name('sales-by-credit-card')->group(function() {
        Route::get('/', [ReportController::class, 'salesByCreditCard']);
        Route::get('/print/{is_concept?}/{office_id?}/{date_type?}/{start_date?}/{end_date?}', [PrintController::class, 'printSalesByCreditCard'])->name('.print');
    });

    Route::prefix('sales-by-state')->name('sales-by-state')->group(function() {
        Route::get('/', [ReportController::class, 'salesByState']);
        Route::get('/print/{state?}/{office_ids?}/{ticket_type_ids?}/{ticket_status?}/{payment_type?}/{date_type?}/{start_date?}/{end_date?}', [PrintController::class, 'printSalesByState'])->name('.print');
    });

    Route::prefix('receivable')->name('receivable')->group(function() {
        Route::get('/', [ReportController::class, 'accountReceivable']);
        Route::get('/print/{office_id?}/{date_type?}/{start_date?}/{end_date?}', [PrintController::class, 'printAccountReceivable'])->name('.print');
    });

    Route::prefix('sales-by-agency')->name('sales-by-agency')->group(function() {
        Route::get('/', [ReportController::class, 'salesByAgency']);
        Route::get('/print/{terminal_ids?}/{office_ids?}/{date_type?}/{start_date?}/{end_date?}', [PrintController::class, 'printSalesByAgency'])->name('.print');
    });

    // Passenger Print
    Route::get('/passenger/print/{type?}/{trip_id?}/{route_id?}/{date_type?}/{start_date?}/{end_date?}', [PrintController::class, 'printPassenger'])->name('passenger.print');
});