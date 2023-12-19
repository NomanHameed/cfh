<?php

namespace App\Http\Controllers\Admin\Item;
use App\Http\Controllers\Controller;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * Class SaleItemController
 * @package App\Http\Controllers
 */
class SaleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:saleItems-list',  ['only' => ['index']]);
        $this->middleware('permission:saleItems-view',  ['only' => ['show']]);
        $this->middleware('permission:saleItems-create',['only' => ['create','store']]);
        $this->middleware('permission:saleItems-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:saleItems-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saleItems = SaleItem::get();

        return view('admin.item.sale.index', compact('saleItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $saleItem = new SaleItem();
        return view('admin.item.sale.create', compact('saleItem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $saleItem = SaleItem::create($request->all());
        return redirect()->route('sale-items.index')
            ->with('success', 'SaleItem created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saleItem = SaleItem::find($id);

        return view('admin.item.sale.show', compact('saleItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saleItem = SaleItem::find($id);

        return view('admin.item.sale.edit', compact('saleItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SaleItem $saleItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleItem $saleItem)
    {
        $saleItem->update($request->all());

        return redirect()->route('sale-items.index')
            ->with('success', 'SaleItem updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $saleItem = SaleItem::find($id)->delete();

        return redirect()->route('sale-items.index')
            ->with('success', 'SaleItem deleted successfully');
    }
    public function importview()
    {
        return view('admin.item.sale.import');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        foreach ($fileContents as $key => $line) {
            if($key != 0){
                $data = str_getcsv($line);

                SaleItem::create([
                    'name' => $data[0],
                    'measurment_unit_id' => $data[1],
                    'price' => $data[2],
                    'status' => $data[3],
                    // Add more fields as needed
                ]);
            }
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');

    }

    public function export() {

        $products = SaleItem::all();
        $csvFileName = 'products.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Name', 'Unit', 'Price', 'Status']); // Add more headers as needed

        foreach ($products as $product) {
            fputcsv($handle, [$product->name, $product->measurment_unit_id, $product->price, $product->status]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }
}
