<?php

namespace App\Traits;

use App\Models\PurchaseDetail;
use App\Models\PurchaseStock;
use App\Models\RecipeDetail;
use App\Models\RecipeStock;
use App\Models\SaleDetail;
use App\Models\SaleItem;
use App\Models\SaleStock;
use Carbon\Carbon;

trait StockTransactions
{

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function purchaseStockIn($bill)
    {
        foreach ($bill->billItems as $item) {
            PurchaseDetail::create([
                'purchase_item_id' => $item->purchase_item_id,
                'type' => 'In',
                'date' => date('Y-m-d', $bill->bill_date),
                'quantity' => $item->quantity
            ]);
            $checkItem = PurchaseStock::where('purchase_item_id', $item->purchase_item_id)->first();
            if ($checkItem) {
                $checkItem->increment('quantity', $item->quantity);
            } else {
                PurchaseStock::create([
                    'purchase_item_id' => $item->purchase_item_id, 'quantity' => $item->quantity
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function purchaseStockOut($recipe)
    {
        $recipe->load('recipeIssueItems');

        foreach ($recipe->recipeIssueItems as $item) {

            PurchaseDetail::create([
                'purchase_item_id' => $item->purchase_item_id,
                'type' => 'Out',
                'date' => date('m-d-Y', $recipe->date),
                'quantity' => $item->quantity
            ]);
            $checkItem = PurchaseStock::where('purchase_item_id', $item->purchase_item_id)->first();
            if ($checkItem) {
                $checkItem->decrement('quantity', $item->quantity);
            } else {
                PurchaseStock::create([
                    'purchase_item_id' => $item->purchase_item_id, 'quantity' => -($item->quantity)
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function saleStockIn($recipe)
    {
        SaleDetail::create([
            'sale_item_id' => $recipe->sale_item_id,
            'type' => 'In',
            'date' => date('m-d-Y', $recipe->date),
            'quantity' => $recipe->quantity
        ]);
        $checkItem = SaleStock::where('sale_item_id', $recipe->sale_item_id)->first();
        if ($checkItem) {
            $checkItem->increment('quantity', $recipe->quantity);
        } else {
            SaleStock::create([
                'sale_item_id' => $recipe->sale_item_id, 'quantity' => $recipe->quantity
            ]);
        }
    }

    public function recipeStockIn($recipe)
    {
        RecipeDetail::create([
            'recipe_name_id' => $recipe->recipe_name_id,
            'type' => 'In',
            'date' => date('m-d-Y', $recipe->date),
            'quantity' => $recipe->quantity
        ]);
        $checkItem = RecipeStock::where('recipe_name_id', $recipe->recipe_name_id)->first();
        if ($checkItem) {
            $checkItem->increment('quantity', $recipe->quantity);
        } else {
            RecipeStock::create([
                'recipe_name_id' => $recipe->recipe_name_id, 'quantity' => $recipe->quantity
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function saleStockOut($invoice)
    {
        foreach ($invoice->invoiceItems as $invoice_item) {

            if($invoice_item){
                SaleDetail::create([
                    'sale_item_id' => $invoice_item->sale_item_id,
                    'type' => 'Out',
                    'date' => Carbon::now(),
                    'quantity' => $invoice_item->quantity
                ]);
                $checkItem = SaleStock::where('sale_item_id', $invoice_item->sale_item_id)->first();
                if ($checkItem) {
                    $checkItem->increment('quantity', $invoice_item->quantity);
                } else {
                    SaleStock::create([
                        'sale_item_id' => $invoice_item->sale_item_id, 'quantity' => $invoice_item->quantity
                    ]);
                }
            }
            foreach ($invoice_item->saleItem->saleIngredients as $productItem) {

                if ($productItem->itemable_type === 'App\Models\Recipe') {
                    RecipeDetail::create([
                        'recipe_name_id' => $productItem->itemable->recipe_name_id,
                        'type' => 'Out',
                        'date' => date('m-d-Y', $productItem->date),
                        'quantity' => ($invoice_item->quantity * $productItem->quantity)
                    ]);
                    $checkItem = RecipeStock::where('recipe_name_id', $productItem->itemable->recipe_name_id)->first();
                    if ($checkItem) {
                        $checkItem->decrement('quantity', ($invoice_item->quantity * $productItem->quantity));
                    } else {
                        RecipeStock::create([
                            'recipe_name_id' => $productItem->itemable->recipe_name_id, 'quantity' => ($invoice_item->quantity * $productItem->quantity)
                        ]);
                    }
                } elseif ($productItem->itemable_type === 'App\Models\PurchaseItem') {

                    // this condition is run if product item belongs to purchase item

                    PurchaseDetail::create([
                        'purchase_item_id' => $productItem->itemable_id,
                        'type' => 'Out',
                        'date' => date('m-d-Y', $invoice->invoice_date),
                        'quantity' => ($invoice_item->quantity * $productItem->quantity)
                    ]);
                    $checkItem = PurchaseStock::where('purchase_item_id', $productItem->itemable_id)->first();
                    if ($checkItem) {
                        $checkItem->decrement('quantity', ($invoice_item->quantity * $productItem->quantity));
                    } else {
                        PurchaseStock::create([
                            'purchase_item_id' => $productItem->itemable_id, 'quantity' => -($invoice_item->quantity * $productItem->quantity)
                        ]);
                    }
                }
            }

        }
    }
}
