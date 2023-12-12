<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Accounts Route
|--------------------------------------------------------------------------
*/
Route::resource('vendors',     'VendorController')->names('vendors');

/*
|--------------------------------------------------------------------------
| Bills Route
|--------------------------------------------------------------------------
*/
Route::controller(BillController::class)->prefix('bills')->as('bills.')->group(function () {
	Route::get('index',				'index'	 )->name('index'	);
	Route::get('create',			'create' )->name('create'	);
	Route::post('store',			'store'	 )->name('store'	);
	Route::get('show/{id}',			'show'	 )->name('show'		);
	Route::get('edit/{id}',			'edit'	 )->name('edit'		);
	Route::patch('update/{bill}',	'update' )->name('update'	);
	Route::patch('publish/{bill}',  'publish')->name('publish'	);
	Route::delete('delete/{id}',	'destroy')->name('destroy'	);
});

/*
|--------------------------------------------------------------------------
| Bill Items Route
|--------------------------------------------------------------------------
*/
Route::controller(BillItemController::class)->prefix('bill/items')->group(function () {
	Route::post('store',			'store'	 )->name('bill.items.store'		);
	Route::patch('update/{item}',	'update' )->name('bill.items.update'	);
	Route::delete('delete/{id}',	'destroy')->name('bill.items.destroy'	);
});

/*
|--------------------------------------------------------------------------
| Payments Route
|--------------------------------------------------------------------------
*/
Route::controller(PurchasePaymentController::class)->prefix('purchase-payments')->as('purchase-payments.')->group(function () {
	Route::get('index',				 'index'  )->name('index'	);
	Route::get('create',			 'create' )->name('create'	);
	Route::post('store',			 'store'  )->name('store'	);
	Route::get('show/{id}',			 'show'	  )->name('show'	);
	Route::get('edit/{id}',			 'edit'	  )->name('edit'	);
	Route::patch('update/{payment}', 'update' )->name('update'	);
	Route::patch('publish/{payment}','publish')->name('publish'	);
	Route::delete('delete/{id}',	 'destroy')->name('destroy'	);
});