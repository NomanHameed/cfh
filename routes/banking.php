<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Accounts Route
|--------------------------------------------------------------------------
*/
Route::resource('accounts',     'AccountController')->names('accounts');

/*
|--------------------------------------------------------------------------
| Transfers Route
|--------------------------------------------------------------------------
*/
Route::resource('transfers',    'TransferController')->names('transfers');

/*
|--------------------------------------------------------------------------
| Transactions Route
|--------------------------------------------------------------------------
*/
Route::resource('transactions', 'TransactionController')->names('transactions');