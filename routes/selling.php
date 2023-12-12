<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Accounts Route
|--------------------------------------------------------------------------
*/
Route::resource('customers',     'CustomerController')->names('customers');

/*
|--------------------------------------------------------------------------
| Bills Route
|--------------------------------------------------------------------------
*/
Route::controller(InvoiceController::class)->prefix('invoices')->as('invoices.')->group(function () {
	Route::get('index',				 'index'  )->name('index'	);
	Route::get('create',			 'create' )->name('create'	);
	Route::post('store',			 'store'  )->name('store'	);
	Route::get('show/{id}',			 'show'	  )->name('show'	);
	Route::get('edit/{id}',			 'edit'	  )->name('edit'	);
	Route::patch('update/{invoice}', 'update' )->name('update'	);
	Route::patch('publish/{invoice}','publish')->name('publish'	);
	Route::delete('delete/{id}',	 'destroy')->name('destroy'	);
});



/*
|--------------------------------------------------------------------------
| Bill Items Route
|--------------------------------------------------------------------------
*/
Route::controller(InvoiceItemController::class)->prefix('invoice/items')->group(function () {
	Route::post('store',			'store'	 )->name('invoice.items.store'	);
	Route::patch('update/{item}',	'update' )->name('invoice.items.update'	);
	Route::delete('delete/{id}',	'destroy')->name('invoice.items.destroy');
});

Route::controller(PrintController::class)->prefix('print')->group(function () {
	Route::get('invoice/{invoice}',			'print'	 )->name('invoice.print'	);
});

/*
|--------------------------------------------------------------------------
| Payments Route
|--------------------------------------------------------------------------
*/
Route::controller(\App\Http\Controllers\Admin\Selling\SalePaymentController::class)->prefix('sale-payments')->as('sale-payments.')->group(function () {
	Route::get('index',				 'index'  )->name('index'	);
	Route::get('create',			 'create' )->name('create'	);
	Route::post('store',			 'store'  )->name('store'	);
	Route::get('show/{id}',			 'show'	  )->name('show'	);
	Route::get('edit/{id}',			 'edit'	  )->name('edit'	);
	Route::patch('update/{payment}', 'update' )->name('update'	);
	Route::patch('publish/{payment}','publish')->name('publish'	);
	Route::delete('delete/{id}',	 'destroy')->name('destroy'	);
});

//Route::get('print', [\App\Http\Controllers\PrintController::class, 'print']);
//Route::get('pdf/invoice',function(){
//    $name = 'Noman';
//
//    $invoice = \Barryvdh\DomPDF\PDF::loadView('print.invoice',array('name'=>$name));
////use which ever path you prefer to save the generated pdf, you do not need to save it you can stream or set for download directly.
////    $invoice->save(storage_path().'/userFolders/uniquename.pdf');
//    return $invoice->stream();
//});
