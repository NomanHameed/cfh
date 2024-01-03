<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\SaleItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class POSController extends Controller
{
    public function index() : View {
        $invoice = new Invoice();
        $products = SaleItem::all();
        return view('admin.pos.index', compact('products', 'invoice'));
    }
}
