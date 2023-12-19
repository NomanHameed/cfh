<?php

namespace App\Http\Controllers\Admin\Selling;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Invoice;
use App\Models\InvoiceItem;

use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

/**
 * Class InvoiceController
 * @package App\Http\Controllers
 */
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:invoices-list', ['only' => ['index']]);
        $this->middleware('permission:invoices-view', ['only' => ['show']]);
        $this->middleware('permission:invoices-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:invoices-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:invoices-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::orderByDesc('id')->get();

        return view('admin.selling.invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoice = new Invoice();
        $products = SaleItem::all();
        return view('admin.selling.invoice.create', compact(['invoice', 'products']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'customer_id'=> 'required'
        ]);
        if($request->filled('moreFields')){
        try {


                DB::beginTransaction();

                $data = $request->all();


                $data['payment'] = ($request->has('payment')) ? $request->payment : 0;

                $invoice = Invoice::create($data);

                $items = $data['moreFields'];
                foreach ($items as $item) {

                    $invoice->invoiceItems()->create(['sale_item_id' => $item['product_id'], 'quantity' => $item['quantity'], 'rate' => $item['rate']]);
                }
                DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }else{
        return redirect()->back()
            ->with('error', 'Please Select Product.');
    }

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $invoice = Invoice::with('invoiceItems')->find($id);

        return view('admin.selling.invoice.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::with('InvoiceItems', 'InvoiceItems.saleItem')->find($id);
        $products = SaleItem::all();

        dd($invoice);
        return view('admin.selling.invoice.edit', compact(['invoice','products']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update($request->all());

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request, Invoice $invoice)
    {
        DB::transaction(function () use ($invoice) {
            $invoice->customer->details()->create([
                'reference' => $invoice->invoice_number,
                'detail' => "Invoice Posted",
                'date' => date('Y-m-d', $invoice->invoice_date),
                'type' => "Paid",
                'amount' => $invoice->calculateTotalAmount()
            ]);
            $invoice->load('invoiceItems');
            $invoice->saleStockOut($invoice);
            if ($invoice->payment_type != 'Pending') {
                if ($invoice->payment_type == 'Cash') {
                    $account = Account::where('default', 'Yes')->first()->id;
                } else {
                    $account = $invoice->account_id;
                }
                $transaction = $invoice->updateBalance($account, $invoice->payment, 'Incoming', 'Invoice');
                $invoice->customer->details()->create([
                    'reference' => $transaction->transaction_id,
                    'detail' => $invoice->payment_type,
                    'date' => date('Y-m-d', $invoice->invoice_date),
                    'type' => "Received",
                    'amount' => $invoice->calculateTotalAmount()
                ]);
            }
            $invoice->update(['status' => 'Posted']);
        });

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice Posted successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id)->delete();

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice deleted successfully');
    }
}
