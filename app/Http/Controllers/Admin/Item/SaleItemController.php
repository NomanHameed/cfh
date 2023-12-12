<?php

namespace App\Http\Controllers\Admin\Item;
use App\Http\Controllers\Controller;
use App\Models\SaleItem;
use Illuminate\Http\Request;

/**
 * Class SaleItemController
 * @package App\Http\Controllers
 */
class SaleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:saleItems-list',  ['only' => ['index']]);
        $this->middleware('permission:saleItems-view',  ['only' => ['show']]);
        $this->middleware('permission:saleItems-create',['only' => ['create','store']]);
        $this->middleware('permission:saleItems-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:saleItems-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saleItems = SaleItem::get();

        return view('admin.item.sale.index', compact('saleItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $saleItem = new SaleItem();
        return view('admin.item.sale.create', compact('saleItem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $saleItem = SaleItem::create($request->all());
        return redirect()->route('sale-items.index')
            ->with('success', 'SaleItem created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saleItem = SaleItem::find($id);

        return view('admin.item.sale.show', compact('saleItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saleItem = SaleItem::find($id);

        return view('admin.item.sale.edit', compact('saleItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SaleItem $saleItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleItem $saleItem)
    {
        $saleItem->update($request->all());

        return redirect()->route('sale-items.index')
            ->with('success', 'SaleItem updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $saleItem = SaleItem::find($id)->delete();

        return redirect()->route('sale-items.index')
            ->with('success', 'SaleItem deleted successfully');
    }
}
