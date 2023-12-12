<?php

namespace App\Http\Controllers\Admin\Production;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderReceiveItem;
use Illuminate\Http\Request;

/**
 * Class OrderReceiveItemController
 * @package App\Http\Controllers
 */
class OrderReceiveItemController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $order = Order::find($id);

        return view('production.order.receive-item.index', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $orderReceiveItem = OrderReceiveItem::create($request->all());
        return redirect()->back()->with('success', 'Receive Item added successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  OrderReceiveItem $orderReceiveItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderReceiveItem $item)
    {
        $item->update($request->all());

        return redirect()->back()->with('success', 'Receive Item updated successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        OrderReceiveItem::find($id)->delete();

        return redirect()->back()->with('success', 'Receive Item deleted successfully.');
    }
}
