<?php

namespace App\Http\Controllers\Admin\Selling;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * Class CustomerController
 * @package App\Http\Controllers
 */
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:customers-list',  ['only' => ['index']]);
        $this->middleware('permission:customers-view',  ['only' => ['show']]);
        $this->middleware('permission:customers-create',['only' => ['create','store']]);
        $this->middleware('permission:customers-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:customers-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderByDesc('id')->get();

        return view('admin.selling.customer.index', compact('customers'));
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // $customers = Customer::where('name','LIKE','%'.$string)->get();
        $parameter = $request->q;
        $page      = $request->page;
        $customers     = Customer::where('name', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('email', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('phone', 'LIKE', '%' . $parameter . '%')
                    ->paginate(10, ['*'], 'page', $page)->toArray();
        return $customers;

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = new Customer();
        return view('admin.selling.customer.create', compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $customer = Customer::create($request->all());
        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        return view('admin.selling.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);

        return view('admin.selling.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $customer = Customer::find($id)->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully');
    }

    public function importview()
    {
        return view('admin.selling.customer.import');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        foreach ($fileContents as $key => $line) {
            if($key != 0){
                $data = str_getcsv($line);

                Customer::create([
                    'name' => $data[0],
                    'phone' => $data[1],
                    'address' => $data[2],
                ]);
            }
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');

    }

    public function export() {

        $customers = Customer::all();
        $csvFileName = 'customers.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Name', 'phone', 'Address']); // Add more headers as needed

        foreach ($customers as $customer) {
            fputcsv($handle, [$customer->name, $customer->phone, $customer->address]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }
}
