<?php

namespace App\Http\Controllers\Admin\Banking;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;

/**
 * Class AccountController
 * @package App\Http\Controllers
 */
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:accounts-list',  ['only' => ['index']]);
        $this->middleware('permission:accounts-view',  ['only' => ['show']]);
        $this->middleware('permission:accounts-create',['only' => ['create','store']]);
        $this->middleware('permission:accounts-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:accounts-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::get();

        return view('admin.banking.account.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account = new Account();
        return view('admin.banking.account.create', compact('account'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = Account::whereNotNull('default')->first();
        if ($request->default =='Yes' && $check) {
            $check->default = Null;
            $check->save();
        }
        $account = Account::create($request->all());
        return redirect()->route('accounts.index')
            ->with('success', 'Account created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = Account::find($id);

        return view('admin.banking.account.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = Account::find($id);

        return view('admin.banking.account.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Account $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        if ($request->default =='Yes' && $account->default == Null) {
            $check = Account::where('id','!=',$account->id)->whereNotNull('default')->first();
            if ($check) {
                $check->default = Null;
                $check->save();
            }
        }
        $account->update($request->all());

        return redirect()->route('accounts.index')
            ->with('success', 'Account updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $account = Account::find($id);
        if ($account->default == 'Yes') {
            return redirect()->route('accounts.index')
            ->with('warning', 'Opps! You can not delete default account.');
        }
        $account->delete();
        return redirect()->route('accounts.index')
            ->with('success', 'Account deleted successfully');
    }
}
