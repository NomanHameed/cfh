<?php

namespace App\Http\Controllers\Admin\Purchasing;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * Class BillController
 * @package App\Http\Controllers
 */
class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:bills-list',  ['only' => ['index']]);
        $this->middleware('permission:bills-view',  ['only' => ['show']]);
        $this->middleware('permission:bills-create',['only' => ['create','store']]);
        $this->middleware('permission:bills-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:bills-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::latest('id')->get();

        return view('admin.purchasing.bill.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bill = new Bill();
        return view('admin.purchasing.bill.create', compact('bill'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bill = Bill::create($request->all());
        return redirect()->route('bills.index')
            ->with('success', 'Bill created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Bill::find($id);

        return view('admin.purchasing.bill.show', compact('bill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bill = Bill::find($id);

        return view('admin.purchasing.bill.edit', compact('bill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        $bill->update($request->all());

        return redirect()->route('bills.index')
            ->with('success', 'Bill updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request, Bill $bill)
    {
        DB::transaction(function () use ($bill) {
            $vendor = $bill->vendor;
            $vendor->details()->create([
                'reference' => $bill->bill_number,
                'detail'    => "Bill Posted",
                'date'      => date('Y-m-d', $bill->bill_date),
                'type'      => "Received",
                'amount'    => $bill->calculateTotalAmount()
            ]);
            $bill->purchaseStockIn($bill);
            $bill->update(['status' => 'Posted']);
        }, 3);

        return redirect()->route('bills.index')
            ->with('success', 'Bill Posted successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bill = Bill::find($id)->delete();

        return redirect()->route('bills.index')
            ->with('success', 'Bill deleted successfully.');
    }
}
