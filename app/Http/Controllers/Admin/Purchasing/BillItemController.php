<?php

namespace App\Http\Controllers\Admin\Purchasing;
use App\Http\Controllers\Controller;
use App\Models\BillItem;
use Illuminate\Http\Request;

/**
 * Class BillItemController
 * @package App\Http\Controllers
 */
class BillItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        BillItem::create($request->all());
        return redirect()->back()->with('success', 'Item added successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BillItem $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BillItem $item)
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
        BillItem::find($id)->delete();

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }
}
