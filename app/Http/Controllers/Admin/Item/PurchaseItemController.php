<?php

namespace App\Http\Controllers\Admin\Item;
use App\Http\Controllers\Controller;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;

/**
 * Class PurchaseItemController
 * @package App\Http\Controllers
 */
class PurchaseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:purchaseItems-list',  ['only' => ['index']]);
        $this->middleware('permission:purchaseItems-view',  ['only' => ['show']]);
        $this->middleware('permission:purchaseItems-create',['only' => ['create','store']]);
        $this->middleware('permission:purchaseItems-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:purchaseItems-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseItems = PurchaseItem::with('unit')->orderBy('name')->get();

        return view('admin.item.purchase.index', compact('purchaseItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchaseItem = new PurchaseItem();
        return view('admin.item.purchase.create', compact('purchaseItem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $purchaseItem = PurchaseItem::create($request->all());
        return redirect()->route('purchase-items.index')
            ->with('success', 'PurchaseItem created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseItem = PurchaseItem::find($id);

        return view('admin.item.purchase.show', compact('purchaseItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchaseItem = PurchaseItem::find($id);

        return view('admin.item.purchase.edit', compact('purchaseItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PurchaseItem $purchaseItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseItem $purchaseItem)
    {
        $purchaseItem->update($request->all());

        return redirect()->route('purchase-items.index')
            ->with('success', 'PurchaseItem updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $purchaseItem = PurchaseItem::find($id)->delete();

        return redirect()->route('purchase-items.index')
            ->with('success', 'PurchaseItem deleted successfully');
    }
}
