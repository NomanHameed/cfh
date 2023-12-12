<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Purchase Itmes Route
|--------------------------------------------------------------------------
*/
Route::resource('purchase-items', 'PurchaseItemController')->names('purchase-items');

/*
|--------------------------------------------------------------------------
| Sale Items Route
|--------------------------------------------------------------------------
*/
Route::resource('sale-items', 'SaleItemController')->names('sale-items');

/*
|--------------------------------------------------------------------------
| Products Route
|--------------------------------------------------------------------------
*/
Route::controller(ProductController::class)->prefix('products')->as('products.')->group(function () {
    Route::get('index',				 'index'  )->name('index'	);
    Route::get('create',			 'create' )->name('create'	);
    Route::post('store',			 'store'  )->name('store'	);
    Route::get('show/{id}',			 'show'	  )->name('show'	);
    Route::get('edit/{id}',			 'edit'	  )->name('edit'	);
    Route::patch('update/{product}', 'update' )->name('update'	);
    Route::delete('delete/{id}',	 'destroy')->name('destroy'	);
});


/*
|--------------------------------------------------------------------------
| Products Route
|--------------------------------------------------------------------------
*/
Route::controller(SaleIngredientController::class)->prefix('sale-ingredients')->as('sale-ingredients.')->group(function () {
    Route::post('store',			 'store'  )->name('store'	);
    Route::get('show/{id}',			 'show'	  )->name('show'	);
    Route::get('edit/{id}',			 'edit'	  )->name('edit'	);
    Route::patch('update/{productItem}', 'update' )->name('update'	);
    Route::delete('delete/{id}',	 'destroy')->name('destroy'	);
});
