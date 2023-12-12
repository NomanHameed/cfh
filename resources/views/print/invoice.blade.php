<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">

</head>
<body>
<div class="container" id="main">
    <div class="row">
        <div class="col-8">
            <a href="http://" ><h1>CFH</h1></a>
        </div>
        <div class="col-4">
            <p class="text my-0">Contact Us/ For Order</p>
            <p class="my-0">0322-6220-365</p>
            <p class="my-0">0311-1125-258</p>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <h6>{{ ($invoice->customer->name) ? $invoice->customer->name : 'Walking Customer'  }}</h6>
        </div>
        <div class="col-2">
            <p class="my-0"><strong> Inv No. </strong></p>
            <p class="my-0">Location</p>
            <p class="my-0">Created On</p>
        </div>
        <div class="col-4">
            <p class="my-0"><strong>39153</strong></p>
            <p class="my-0">{{ ($invoice->customer->address) ? $invoice->customer->address : 'XYZ'  }}</p>
            <p class="my-0">{{ ($invoice->created_at) ? $invoice->created_at : 'XYZ'  }}</p>
        </div>
    </div>

    <section>
        <table class="table table-bordered table-sm">
            <thead>
            <tr>
                <th class="col">SR</th>
                <th class="col">Product Name</th>
                <th class="col">UM Unit</th>
                <th class="col">UM Quantity</th>
                <th class="col">Rate</th>
                <th class="col">Amount</th>
            </tr>
            </thead>
            <tbody>

            @foreach($invoice->invoiceItems as $key => $invoiceItem)
            <tr>
                <th>{{ $key }}</th>
                <td>{{ $invoiceItem->saleItem->name }}</td>
                <td>Each</td>
                <td> {{ $invoiceItem->quantity }}</td>
                <td> {{ $invoiceItem->rate }}</td>
                <td> {{ $invoiceItem->quantity * $invoiceItem->rate }}</td>
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
                <td colspan="5" class="text-end">Amount Total:</td>
                <td>$200.00</td>
            </tr>
            </tbody>
        </table>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script>
    // window.addEventListener("load", window.print());
</script>

</body>
</html>


