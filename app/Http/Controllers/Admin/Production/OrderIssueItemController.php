<?php

namespace App\Http\Controllers\Admin\Production;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderIssueItem;
use Illuminate\Http\Request;

/**
 * Class OrderIssueItemController
 * @package App\Http\Controllers
 */
class OrderIssueItemController extends Controller
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

        return view('admin.production.order.issue-item.index', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        OrderIssueItem::create($request->all());
        return redirect()->back()->with('success', 'Issue Item added successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  OrderIssueItem $orderIssueItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderIssueItem $item)
    {
        $item->update($request->all());

        return redirect()->back()->with('success', 'Issue Item updated successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        OrderIssueItem::find($id)->delete();

        return redirect()->back()->with('success', 'Issue Item deleted successfully.');
    }
}
