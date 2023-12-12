<?php

namespace App\Http\Controllers\Admin\Banking;
use App\Http\Controllers\Controller;
use App\Models\Transfer;
use Illuminate\Http\Request;

/**
 * Class TransferController
 * @package App\Http\Controllers
 */
class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:transfers-list',  ['only' => ['index']]);
        $this->middleware('permission:transfers-view',  ['only' => ['show']]);
        $this->middleware('permission:transfers-create',['only' => ['create','store']]);
        $this->middleware('permission:transfers-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:transfers-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transfers = Transfer::get();

        return view('admin.banking.transfer.index', compact('transfers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transfer = new Transfer();
        return view('admin.banking.transfer.create', compact('transfer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transfer = Transfer::create($request->all());
        $transfer->updateBalance($request->from_account, $request->amount, 'Outgoing', 'Transfer');
        $transfer->updateBalance($request->to_account, $request->amount, 'Incoming', 'Transfer');
        return redirect()->route('transfers.index')
            ->with('success', 'Transfer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transfer = Transfer::find($id);

        return view('admin.banking.transfer.show', compact('transfer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transfer = Transfer::find($id);

        return view('admin.banking.transfer.edit', compact('transfer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Transfer $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transfer $transfer)
    {
        if ($transfer->amount != $request->amount) {
            if ($request->amount > $transfer->amount) {
                $extra = $request->amount - $transfer->amount;
                $transfer->updateBalance($transfer->from_account, $extra, 'Outgoing', 'Transfer');
                $transfer->updateBalance($transfer->to_account, $extra, 'Incoming', 'Transfer');
            }
            if ($request->amount < $transfer->amount) {
                $less = $request->amount - $transfer->amount;
                $transfer->updateBalance($transfer->from_account, $less, 'Incoming', 'Transfer');
                $transfer->updateBalance($transfer->to_account, $less, 'Outgoing', 'Transfer');
            }
        }
        $transfer->update($request->all());

        return redirect()->route('transfers.index')
            ->with('success', 'Transfer updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $transfer = Transfer::find($id)->delete();

        return redirect()->route('transfers.index')
            ->with('success', 'Transfer deleted successfully');
    }
}
