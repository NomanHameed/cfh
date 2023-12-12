<?php

namespace App\Http\Controllers\Admin\Selling;


use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
    public function print(Invoice $invoice)
    {
        $invoice->load(['customer', 'invoiceItems','invoiceItems.saleItem',]);
        return view('print.invoice',compact('invoice'));
    }
}
