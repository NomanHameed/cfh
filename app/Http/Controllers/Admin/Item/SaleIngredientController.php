<?php

namespace App\Http\Controllers\Admin\Item;
use App\Http\Controllers\Controller;

use App\Models\PurchaseItem;
use App\Models\Recipe;
use App\Models\SaleIngredient;
use App\Models\SaleItem;
use Illuminate\Http\Request;

/**
 * Class SaleIngredientController
 * @package App\Http\Controllers
 */
class SaleIngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:saleIngredients-list',  ['only' => ['index']]);
        $this->middleware('permission:saleIngredients-view',  ['only' => ['show']]);
        $this->middleware('permission:saleIngredients-create',['only' => ['create','store']]);
        $this->middleware('permission:saleIngredients-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:saleIngredients-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saleIngredients = SaleIngredient::get();

        return view('admin.sale-ingredient.index', compact('saleIngredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $saleIngredient = new SaleIngredient();
        return view('admin.sale-ingredient.create', compact('saleIngredient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->type == 'Purchase Item') {
            $itemable = PurchaseItem::find($request->parent_id_purchase);
            $itemableType = PurchaseItem::class;
        } elseif ($request->type == 'Recipe') {
            $itemable = Recipe::find($request->parent_id_sale);
            $itemableType = Recipe::class;
        }
       $saleIngredient = new SaleIngredient();
        $saleIngredient->sale_item_id = $request->sale_item_id;
        $saleIngredient->quantity =  $request->quantity;
        $saleIngredient->itemable()->associate($itemable);
        $saleIngredient->save();
        return redirect()->back()
            ->with('success', 'Sale Ingredients added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saleItem = SaleItem::with('saleIngredients')->find($id);

        return view('admin.item.sale.ingredient', compact('saleItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saleIngredient = SaleIngredient::find($id);

        return view('admin.sale-ingredient.edit', compact('saleIngredient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SaleIngredient $saleIngredient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleIngredient $saleIngredient)
    {
        $saleIngredient->update($request->all());

        return redirect()->route('sale-ingredients.index')
            ->with('success', 'SaleIngredient updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $saleIngredient = SaleIngredient::find($id)->delete();

        return redirect()->back()
            ->with('success', 'SaleIngredient deleted successfully');
    }
}
