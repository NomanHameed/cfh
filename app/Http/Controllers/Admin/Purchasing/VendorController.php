<?php

namespace App\Http\Controllers\Admin\Purchasing;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

/**
 * Class VendorController
 * @package App\Http\Controllers
 */
class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:vendors-list',  ['only' => ['index']]);
        $this->middleware('permission:vendors-view',  ['only' => ['show']]);
        $this->middleware('permission:vendors-create',['only' => ['create','store']]);
        $this->middleware('permission:vendors-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:vendors-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::orderBy('name')->get();

        return view('admin.purchasing.vendor.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendor = new Vendor();
        return view('admin.purchasing.vendor.create', compact('vendor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vendor = Vendor::create($request->all());

        return redirect()->route('vendors.index')
            ->with('success', 'Vendor created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendor = Vendor::find($id);

        return view('admin.purchasing.vendor.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::find($id);

        return view('admin.purchasing.vendor.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        $vendor->update($request->all());

        return redirect()->route('vendors.index')
            ->with('success', 'Vendor updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $vendor = Vendor::find($id)->delete();

        return redirect()->route('vendors.index')
            ->with('success', 'Vendor deleted successfully');
    }
}
