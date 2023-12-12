<?php

namespace App\Http\Controllers\Admin\Production;
use App\Http\Controllers\Controller;
use App\Models\Order;
use DB;
use Illuminate\Http\Request;

/**
 * Class OrderController
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:orders-list',  ['only' => ['index']]);
        $this->middleware('permission:orders-view',  ['only' => ['show']]);
        $this->middleware('permission:orders-create',['only' => ['create','store']]);
        $this->middleware('permission:orders-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:orders-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::get();

        return view('admin.production.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = new Order();
        return view('admin.production.order.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $order = Order::create($request->all());
        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);

        return view('admin.production.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);

        return view('admin.production.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->all());

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Order $order
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request, Order $order)
    {
        DB::transaction(function () use ($order) {
            $order->purchaseStockOut($order);
            $order->update(['status' => 'Posted']);
        });
        return redirect()->route('orders.index')
            ->with('success', 'Order posted successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Order $order
     * @return \Illuminate\Http\Response
     */
    public function receive(Request $request, Order $order)
    {
        DB::transaction(function () use ($order) {
            $order->worker->details()->create([
                'reference' => $order->order_number,
                'detail'    => "Order Received",
                'date'      => date('Y-m-d', $order->receive_date),
                'type'      => "Received",
                'amount'    => $order->calculateTotalAmount()
            ]);
            $order->saleStockIn($order);
            $order->update(['status' => 'Received']);
        });
        return redirect()->route('orders.index')
            ->with('success', 'Order received successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $order = Order::find($id)->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully');
    }
}
