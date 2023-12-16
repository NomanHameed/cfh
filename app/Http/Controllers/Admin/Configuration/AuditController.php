<?php

namespace App\Http\Controllers\Admin\Configuration;
use App\Http\Controllers\Controller;
use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:audits-list',  ['only' => ['index']]);
        $this->middleware('permission:audits-view',  ['only' => ['show']]);
        $this->middleware('permission:audits-create',['only' => ['create','store']]);
        $this->middleware('permission:audits-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:audits-delete',['only' => ['destroy']]);
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $audits = Audit::with('user')->orderBy('created_at', 'desc')->get();

	    return view('admin.configuration.audit.index', compact('audits'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $audit = Audit::find($id);

        return view('admin.configuration.audit.show', compact('audit'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $audit = Audit::find($id)->delete();

        return redirect()->route('audits.index')
            ->with('success', 'Audit deleted successfully.');
    }
}
