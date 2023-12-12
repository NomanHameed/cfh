@extends('admin.layouts.app')

@section('title')
    Invoice Purchase Item
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Invoice Purchase Item Managment</span>
        </h4>
    </div>
    @can('invoice-purchase-items-create')
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('invoice-purchase-items.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">Invoice Purchase Item</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>

										<th>Invoice Id</th>
										<th>Purchase Item Id</th>
										<th>Description</th>
										<th>Quantity</th>
										<th>Rate</th>

                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($invoicePurchaseItems as $key => $invoicePurchaseItem)
                <tr>
                    <td>{{ ++$key }}</td>

											<td>{{ $invoicePurchaseItem->invoice_id }}</td>
											<td>{{ $invoicePurchaseItem->purchase_item_id }}</td>
											<td>{{ $invoicePurchaseItem->description }}</td>
											<td>{{ $invoicePurchaseItem->quantity }}</td>
											<td>{{ $invoicePurchaseItem->rate }}</td>

                    <td class="text-center">@include('invoice-purchase-item.actions')</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@canany(['invoice-purchase-items-view', 'invoice-purchase-items-edit', 'invoice-purchase-items-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('invoice-purchase-items.destroy',$invoicePurchaseItem->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('invoice-purchase-items-view')
                    <a href="{{ route('invoice-purchase-items.show',$invoicePurchaseItem->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('invoice-purchase-items-edit')
                    <a href="{{ route('invoice-purchase-items.edit',$invoicePurchaseItem->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('invoice-purchase-items-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany
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
