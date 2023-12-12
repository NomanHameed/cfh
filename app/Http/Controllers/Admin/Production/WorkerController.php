<?php

namespace App\Http\Controllers\Admin\Production;
use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Http\Request;

/**
 * Class WorkerController
 * @package App\Http\Controllers
 */
class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:workers-list',  ['only' => ['index']]);
        $this->middleware('permission:workers-view',  ['only' => ['show']]);
        $this->middleware('permission:workers-create',['only' => ['create','store']]);
        $this->middleware('permission:workers-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:workers-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = Worker::get();

        return view('admin.production.worker.index', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $worker = new Worker();
        return view('admin.production.worker.create', compact('worker'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $worker = Worker::create($request->all());
        return redirect()->route('workers.index')
            ->with('success', 'Worker created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $worker = Worker::find($id);

        return view('admin.production.worker.show', compact('worker'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $worker = Worker::find($id);

        return view('admin.production.worker.edit', compact('worker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Worker $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {
        $worker->update($request->all());

        return redirect()->route('workers.index')
            ->with('success', 'Worker updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $worker = Worker::find($id)->delete();

        return redirect()->route('workers.index')
            ->with('success', 'Worker deleted successfully');
    }
}
