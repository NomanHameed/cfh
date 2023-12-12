<?php

use App\Models\Bank;
use App\Models\Shop;
use App\Models\Account;
use App\Models\Vendor;
use App\Models\Customer;
use App\Models\Worker;
use App\Models\PurchaseItem;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\RecipeName;
/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function banks()
{
    return Bank::pluck('title','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function recipieNames()
{
    return RecipeName::pluck('name','id');
}
/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function shops()
{
    return Shop::pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function accounts()
{
    return Account::pluck('title','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function vendors()
{
    return Vendor::pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function customers()
{
    return Customer::pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function workers()
{
    return Worker::pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function purchaseItems()
{
    $items = PurchaseItem::pluck('name','id');

//        ->mapWithKeys(function ($item, $key) {
//        $string = "{$item->name} ( L={$item->length} W={$item->width} T={$item->thikness} )";
//        return [$item->id => $string];
//    })->toArray();

    return $items;
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function saleItems()
{
    $items = SaleItem::pluck('name','id');
    return $items;
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function saleProducts()
{
    $products = SaleItem::where('status','Active')->get();
    $items = $products->map(function ($product) {
        return [$product->id =>  $product->name . ' - Rs: ' . number_format($product->price, 2)];
    });
    $items = $items[0];
    return $items;
}



/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function units()
{
    return \App\Models\MeasurmentUnit::pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function status()
{
    return ['Active'=> 'Active', 'Deactive'=> 'Deactive'];
}

function transectoionType()
{
    return ['In'=>'In','Out'=>'Out'];
}


