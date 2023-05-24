<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/* Get */
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/api/consumer', [ApiController::class, 'index']);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    /* Buses */
    Route::resource('buses', BusController::class);
    /* Drivers */
    Route::resource('conductores', DriverController::class);
    /* Rutas */
    Route::resource('rutas', RouteController::class);
    /* Seguros */
    Route::resource('seguros', InsuranceController::class);
    /* Boletos */
    Route::resource('boletos', TicketController::class);
    /* Reportes */
});
