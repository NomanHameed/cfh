<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body{
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }
        .fontsm {
            font-size: 10px;
        }
        .add{
            font-size: 12px;
        }
    </style>
</head>
<body>
<div id="main mb-5">
    <div class="row justify-content-center">
        <div class="col-6">
            <img style="height: 150px; width:150px;" src="{{ url('images/CFH_LOGO.png')}}" alt="">
        </div>
        <div class="col-6">
            <p class="text my-0">Contact / Order</p>
            <p class="my-0">0322-6220-365</p>
            <p class="my-0">0303-7417-107</p>
            <p class="my-0">0337-7014-867</p>
            <p class="my-0">0322-8691-102</p>
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <p class="m-0 add"><small>
                {{ ($invoice->customer->name) ? $invoice->customer->name : 'Walking Customer'  }}
                </small>
            </p>
            <p class="m-0 add">
                <small>
                    {{ ($invoice->customer->address) ? $invoice->customer->address : ''  }}
                </small>
            </p>
        </div>
        <div class="col-7">
            <div class="row">
                <div class="col-4">
                    <strong><small>Inv #</small></strong>
                </div>
                <div class="col-8">
                    <small>{{ $invoice->invoice_number }}</small>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <strong><small>Contact:</small></strong>
                </div>
                <div class="col-8">
                    <small>
                    {{ ($invoice->customer->phone) ? $invoice->customer->phone : ''  }}
                    </small>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <strong><small>Date:</small></strong>
                </div>
                <div class="col-8">
                    <small>
                        {{ ($invoice->created_at) ?  \Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y') : ''  }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-sm">

            <div class="row">
                <th class="col-sm-1 fontsm">SR</th>
                <th class="col-sm-8 fontsm">Product Name</th>
                <th class="col-sm-2 fontsm">Unit</th>
                <th class="col-sm-1 fontsm">Qnty</th>
                <th class="col-sm-1 fontsm">Rate</th>
                <th class="col-sm-1 fontsm">Amt</th>
            </div>
            <tbody>

            @foreach($invoice->invoiceItems as $key => $invoiceItem)
            <tr>
                <th  class=" fontsm"><small>{{ ($key + 1) }}</small></th>
                <td  class=" fontsm"><small>{{ $invoiceItem->saleItem->name }}</small></td>
                <td  class=" fontsm"><small>{{ ($invoiceItem->saleItem->unit->name == 'number') ? '#' : $invoiceItem->saleItem->unit->name }}</small></td>
                <td  class=" fontsm"><small>{{ $invoiceItem->quantity }}</small></td>
                <td  class=" fontsm"><small>{{ $invoiceItem->rate }}</small></td>
                <td  class=" fontsm"><small>{{ $invoiceItem->quantity * $invoiceItem->rate }}</small></td>
            </tr>
            @endforeach

            <tr>
                <td colspan="5" class="text-end"><strong>Total:</strong></td>
                <td><strong>{{ $invoice->calculateTotalAmount() }}</strong></td>
            </tr>

            <tr>
                <td colspan="5" class="text-end">Arrears:</td>
                <td>{{ getCustomerLastBalance($invoice->customer) }}</td>
            </tr>

            <tr>
                <td colspan="5" class="text-end">Amount Payable:</td>

                <td>{{ amountPayable($invoice->calculateTotalAmount(), $invoice->customer) }}</td>
            </tr>
            </tbody>
        </table>
    </d>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
    window.addEventListener("load", window.print());
</script>

</body>
</html>


