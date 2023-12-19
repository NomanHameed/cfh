<?php

namespace App\Http\Controllers\Admin\Selling;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\SalePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class SalePaymentController
 * @package App\Http\Controllers
 */
class SalePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:salePayments-list',  ['only' => ['index']]);
        $this->middleware('permission:salePayments-view',  ['only' => ['show']]);
        $this->middleware('permission:salePayments-create',['only' => ['create','store']]);
        $this->middleware('permission:salePayments-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:salePayments-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salePayments = SalePayment::with('customer')->orderByDesc('id')->get();

        return view('admin.selling.payment.index', compact('salePayments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salePayment = new SalePayment();
        return view('admin.selling.payment.create', compact('salePayment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {$status = DB::transaction(function () use ($request) {

        $status = 'No error';
            $account = Account::whereNotNull('default')->first();
            if (empty($account)) {
                $status = 'Error';
            }else{
                $payment = SalePayment::create($request->all());

                $transaction = $payment->updateBalance($account->id, $payment->amount, 'Incoming', 'Sale');
                $payment->customer->details()->create([
                    'reference' => $transaction->transaction_id,
                    'detail'    => 'Payment Received',
                    'date'      => date('Y-m-d', $payment->date),
                    'type'      => 'Received',
                    'amount'    => $payment->amount
                ]);

            }
            return $status;
        });
        if ($status == 'Error') {
            return redirect()->back()->with('warning', 'Default Account not set');
        }

       return redirect()->route('sale-payments.index')
            ->with('success', 'SalePayment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salePayment = SalePayment::find($id);

        return view('admin.selling.payment.show', compact('salePayment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salePayment = SalePayment::find($id);

        return view('admin.selling.payment.edit', compact('salePayment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SalePayment $salePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalePayment $salePayment)
    {
        $salePayment->update($request->all());

        return redirect()->route('sale-payments.index')
            ->with('success', 'SalePayment updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $salePayment = SalePayment::find($id)->delete();

        return redirect()->route('sale-payments.index')
            ->with('success', 'SalePayment deleted successfully');
    }
}
