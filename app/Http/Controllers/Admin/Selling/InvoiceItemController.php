<?php

namespace App\Http\Controllers\Admin\Selling;
use App\Http\Controllers\Controller;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

/**
 * Class InvoiceItemController
 * @package App\Http\Controllers
 */
class InvoiceItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        InvoiceItem::create($request->all());
        return redirect()->back()->with('success', 'Item added successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  InvoiceItem $invoiceItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceItem $item)
    {
        $item->update($request->all());

        return redirect()->back()->with('success', 'Item updated successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        InvoiceItem::find($id)->delete();

        return redirect()->back()->with('success', 'Item removed successfully.');
    }
}
