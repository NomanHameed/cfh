<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Purchase Itmes Route
|--------------------------------------------------------------------------
*/
Route::resource('purchase-stocks', 'PurchaseStockController')->names('purchase-stocks');

/*
|--------------------------------------------------------------------------
| Sale Items Route
|--------------------------------------------------------------------------
*/
Route::resource('sale-stocks', 'SaleStockController')->names('sale-stocks');