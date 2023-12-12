<?php

namespace App\Http\Controllers\Admin\Purchasing;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\PurchasePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class PurchasePaymentController
 * @package App\Http\Controllers
 */
class PurchasePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:purchasePayments-list',  ['only' => ['index']]);
        $this->middleware('permission:purchasePayments-view',  ['only' => ['show']]);
        $this->middleware('permission:purchasePayments-create',['only' => ['create','store']]);
        $this->middleware('permission:purchasePayments-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:purchasePayments-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchasePayments = PurchasePayment::with('vendor')->get();

        return view('admin.purchasing.payment.index', compact('purchasePayments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchasePayment = new PurchasePayment();
        return view('admin.purchasing.payment.create', compact('purchasePayment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $purchasePayment = PurchasePayment::create($request->all());
        return redirect()->route('purchase-payments.index')
            ->with('success', 'PurchasePayment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchasePayment = PurchasePayment::find($id);

        return view('admin.purchasing.payment.show', compact('purchasePayment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchasePayment = PurchasePayment::find($id);

        return view('admin.purchasing.payment.edit', compact('purchasePayment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PurchasePayment $purchasePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchasePayment $payment)
    {
        $payment->update($request->all());

        return redirect()->route('purchase-payments.index')
            ->with('success', 'PurchasePayment updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PurchasePayment $purchasePayment
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request, PurchasePayment $payment)
    {
        $status = DB::transaction(function () use ($payment) {
            $status = 'No error';
            $account = Account::whereNotNull('default')->first();
            if (empty($account)) {
                $status = 'Error';
            }else{
                $transaction = $payment->updateBalance($account->id, $payment->amount, 'Outgoing', 'Purchasing');
                $payment->vendor->details()->create([
                    'reference' => $transaction->transaction_id,
                    'detail'    => 'Payment Paid',
                    'date'      => date('Y-m-d', $payment->date),
                    'type'      => 'Paid',
                    'amount'    => $payment->amount
                ]);
                $payment->update(['status' => 'approved']);
            }
            return $status;
        });
        if ($status == 'Error') {
            return redirect()->back()->with('warning', 'Opps! Default Account not found.');
        }
        return redirect()->route('purchase-payments.index')
            ->with('success', 'Purchase Payment approved successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $purchasePayment = PurchasePayment::find($id)->delete();

        return redirect()->route('purchase-payments.index')
            ->with('success', 'PurchasePayment deleted successfully');
    }
}
