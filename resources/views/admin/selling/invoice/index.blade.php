@extends('admin.layouts.app')

@section('title')
    Invoice
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Invoice Managment</span>
        </h4>
    </div>
    @can('invoices-create')
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('pos.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Create New
            </a>
        </div>
    </div>
    @endcan
</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Invoice</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
					<th>Invoice Number</th>
                    <th>Customer</th>
					<th>Invoice Date</th>
                    <th>Created By</th>
					<th>Amount</th>
					<th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($invoices as $key => $invoice)
                <tr>
                    <td>{{ ++$key }}</td>
					<td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->customer->name }}</td>
					<td>{{ date('d-m-Y', $invoice->invoice_date) }}</td>
					<td>{{ $invoice->creator?->name }}</td>
                    <td>{{ $invoice->calculateTotalAmount() }}</td>
                    <td>
                        <span class="badge {{ $invoice->status == 'Posted' ? 'bg-success' : 'bg-secondary'}}">{{ $invoice->status }}</span>
                    </td>
                    <td class="text-center">@include('admin.selling.invoice.actions')</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function () {
        const swalInit = swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light',
                denyButton: 'btn btn-light',
                input: 'form-control'
            }
        });
        $(".sa-confirm").click(function (event) {
            event.preventDefault();
            swalInit.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.value === true)  $(this).closest("form").submit();
            });
        });
    });
</script>
@endsection
