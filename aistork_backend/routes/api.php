<?php

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StatusResourceController;
use \App\Http\Controllers\DirectionController;
use \App\Http\Controllers\OrderController;
use \App\Http\Controllers\BoxController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\EmployerBalanceHistoryController;
use \App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use \App\Http\Controllers\ProfileController;
use \App\Http\Controllers\ShippingController;
use \App\Http\Controllers\SendController;
use App\Jobs\SendSMSJob;
use App\Models\BalanceHistory;
use App\Models\DailyReportOrders;
use App\Models\Order;
use App\Models\ReportDaily;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user', [AuthController::class, 'userProfile']);
    Route::post('/number-check', [AuthController::class, 'numberCheck']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::post('/update', [AuthController::class, 'update']);
});

Route::group(['middleware' => ['api', 'auth'], 'prefix' => 'profile'], function () {
    Route::post('', [ProfileController::class, 'update']);
    Route::post('/change-password', [ProfileController::class, 'changePassword']);
    Route::post('/change-avatar', [ProfileController::class, 'changeAvatar']);

    Route::get('find-order', [ProfileController::class, 'findOrder']);
    Route::get('/get-orders', [ProfileController::class, 'getOrders']);
    Route::get('/get-pay-orders', [ProfileController::class, 'getPayOrders']);

    Route::post('/delivery-orders', [ProfileController::class, 'deliveryOrders']);
    Route::get('/get-deliveries', [ProfileController::class, 'getDeliveries']);

    Route::get('/get-statistic', [ProfileController::class, 'getStatistic']);

    Route::get('/get-order-price/{id}', [ProfileController::class, 'getOrderPrice']);


});

Route::group(['prefix' => ''], function () {
    Route::get('posts', [HomeController::class, 'posts']);
    Route::get('posts/{id}', [HomeController::class, 'singlePost']);
    Route::get('other-status', [HomeController::class, 'otherStatus']);
});

Route::group(['middleware' => ['api', 'auth'], 'prefix' => 'dashboard'], function ($router) {
    Route::apiResources([
        'clients'                           => UserController::class,
        'employees'                         => EmployeeController::class,
        'resources'                         => StatusResourceController::class,
        'roles'                             => RolesController::class,
        'posts'                             => PostController::class,
        'directions'                        => DirectionController::class,
        'orders'                            => OrderController::class,
        'shippings'                         => ShippingController::class,
        'boxes'                             => BoxController::class,
        'sends'                             => SendController::class,
        'employer_balance_histories'        => EmployerBalanceHistoryController::class,
        'deliveries'                        => DeliveryController::class,
        'payments'                          => PaymentController::class,
    ]);
    Route::get('', [DashboardController::class, 'index']);

    Route::get('get-data', [DashboardController::class, 'getData']);

    Route::get('get-kanban', [DashboardController::class, 'getKanban']);
    
    Route::post('reception', [BoxController::class, 'reception']);

    Route::get('remain-orders', [DashboardController::class, 'remainOrders']);

    Route::get('pay-histories', [DashboardController::class, 'balanceHistories']);
    // Report
    Route::get('report-daily', [DashboardController::class, 'reportDaily']);
    Route::post('report-daily-status/{id}', [DashboardController::class, 'reportDailyChangeStatus']);
    Route::get('report-daily/{id}', [DashboardController::class, 'reportDailyShow']);
    Route::get('report-monthly', [DashboardController::class, 'reportMonthly']);
    Route::post('report-monthly-status/{id}', [DashboardController::class, 'reportMonthlyChangeStatus']);
    Route::get('report-monthly/{id}', [DashboardController::class, 'reportMonthlyShow']);

    Route::get('get-expenses/{type}', [DashboardController::class, 'getExpenses']);

    Route::get('get-analitics', [DashboardController::class, 'getAnalitics']);

    
    Route::group(['prefix' => 'return'], function() {
        Route::post('orders', [DashboardController::class, 'changeReturnOrders']);
        Route::post('boxes', [DashboardController::class, 'changeReturnBoxes']);
    });
    

});

Route::post('upload-files/{dir}', [DashboardController::class, 'uploadFiles']);

Route::get('test', function () {
    // $start = Carbon::now()->startOfMonth();
    // $end = Carbon::now();

    // $start = new Carbon('first day of last month');
    // $end = new Carbon('last day of last month');

    
    
    // return  response()->json([
    //     's' => 1
    // ]);
});
