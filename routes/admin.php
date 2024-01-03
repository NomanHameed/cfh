<?php

use App\Http\Controllers\Admin\POSController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Route
|--------------------------------------------------------------------------
*/
Route::get('dashboard', DashboardController::class)->name('dashboard');

/*
|--------------------------------------------------------------------------
| Banks Route
|--------------------------------------------------------------------------
*/
Route::resource('banks', BankController::class)->names('banks');

/*
|--------------------------------------------------------------------------
| Measurment Units Route
|--------------------------------------------------------------------------
*/
Route::resource('measurment-units', MeasurmentUnitController::class)->names('measurment-units');

/*
|--------------------------------------------------------------------------
| Shops Route
|--------------------------------------------------------------------------
*/
Route::resource('shops', ShopController::class)->names('shops');

/*
|--------------------------------------------------------------------------
| Items Routes
|--------------------------------------------------------------------------
*/
Route::prefix('item')->namespace('Item')->group(__DIR__.'/item.php');

/*
|--------------------------------------------------------------------------
| Stocks Routes
|--------------------------------------------------------------------------
*/
Route::prefix('stock')->namespace('Stock')->group(__DIR__.'/stock.php');

/*
|--------------------------------------------------------------------------
| Purchasing Routes
|--------------------------------------------------------------------------
*/
Route::prefix('purchasing')->namespace('Purchasing')->group(__DIR__.'/purchasing.php');

/*
|--------------------------------------------------------------------------
| Selling Routes
|--------------------------------------------------------------------------
*/
Route::prefix('selling')->namespace('Selling')->group(__DIR__.'/selling.php');

/*
|--------------------------------------------------------------------------
| Production Routes
|--------------------------------------------------------------------------
*/
Route::prefix('production')->namespace('Production')->group(__DIR__.'/production.php');

/*
|--------------------------------------------------------------------------
| Banking Routes
|--------------------------------------------------------------------------
*/
Route::prefix('banking')->namespace('Banking')->group(__DIR__.'/banking.php');

/*
|--------------------------------------------------------------------------
| Configuratioin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('configuration')->namespace('Configuration')->group(__DIR__.'/configuration.php');




Route::controller(POSController::class)->prefix('pos')->as('pos.')->group(function () {
	Route::get('/',				 'index'  )->name('index'	);
});
