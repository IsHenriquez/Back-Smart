<?php
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
Route::get('/info', function () {phpinfo();});
Route::get('/reiniciar-cache', function () {\Artisan::call('cache:clear'); \Artisan::call('config:clear'); \Artisan::call('queue:restart'); echo "Caché reiniciado";});
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'loginWithToken']);
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

//Route::middleware(['auth:sanctum'])->group(function () {
    Route::resources([
        'announcement'                          =>  'App\Http\Controllers\AnnouncementController',
        'customer'                              =>  'App\Http\Controllers\CustomerController',
        'nps'                                   =>  'App\Http\Controllers\NPSController',
        'position'                              =>  'App\Http\Controllers\PositionController',
        'ticket'                                =>  'App\Http\Controllers\TicketsController',
        'ticket-category'                       =>  'App\Http\Controllers\TicketsCategoryController',
        'ticket-priority'                       =>  'App\Http\Controllers\TicketsPriorityController',
        'ticket-status'                         =>  'App\Http\Controllers\TicketsStatusController',
        'ticket-type'                           =>  'App\Http\Controllers\TicketsTypeController',
        'user'                                  =>  'App\Http\Controllers\UserController',
        'user-type'                             =>  'App\Http\Controllers\UserTypeController',
        'vehicle'                               =>  'App\Http\Controllers\VehiclesController',
        'vehicle-brand'                         =>  'App\Http\Controllers\VehiclesBrandController',
        'vehicle-model'                         =>  'App\Http\Controllers\VehiclesModelController',

    ]);

//});
Route::get('event-list','App\Http\Controllers\TicketsController@eventList');
