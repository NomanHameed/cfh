<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\MeasurmentUnit;
use Illuminate\Http\Request;

/**
 * Class MeasurmentUnitController
 * @package App\Http\Controllers
 */
class MeasurmentUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:measurmentUnits-list',  ['only' => ['index']]);
        $this->middleware('permission:measurmentUnits-view',  ['only' => ['show']]);
        $this->middleware('permission:measurmentUnits-create',['only' => ['create','store']]);
        $this->middleware('permission:measurmentUnits-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:measurmentUnits-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $measurmentUnits = MeasurmentUnit::get();

        return view('admin.measurment-unit.index', compact('measurmentUnits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $measurmentUnit = new MeasurmentUnit();
        return view('admin.measurment-unit.create', compact('measurmentUnit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $measurmentUnit = MeasurmentUnit::create($request->all());
        return redirect()->route('measurment-units.index')
            ->with('success', 'MeasurmentUnit created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $measurmentUnit = MeasurmentUnit::find($id);

        return view('admin.measurment-unit.show', compact('measurmentUnit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $measurmentUnit = MeasurmentUnit::find($id);

        return view('admin.measurment-unit.edit', compact('measurmentUnit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  MeasurmentUnit $measurmentUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MeasurmentUnit $measurmentUnit)
    {
        $measurmentUnit->update($request->all());

        return redirect()->route('measurment-units.index')
            ->with('success', 'MeasurmentUnit updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $measurmentUnit = MeasurmentUnit::find($id)->delete();

        return redirect()->route('measurment-units.index')
            ->with('success', 'MeasurmentUnit deleted successfully');
    }
}
