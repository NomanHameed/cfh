@extends('layouts.app')

@section('title')
    Order Receive Item
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Order Receive Item Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('orders.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-arrow-circle-left"></i>
                </span>
                Back
            </a>
            @if($order->status =='Posted')
            <form method="POST" action="{{ route('orders.receive', $order->id) }}">
                @csrf
                {{ method_field('PATCH') }}
                <button type="submit" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill ms-2 sa-receive">
                    <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                        <i class="ph-arrow-u-up-left"></i>
                    </span>
                    Post
                </button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="mb-0">Order Production Material</h5>
            <div class="d-inline-flex ms-auto">
                <span class="badge bg-success rounded-pill">{{ $order->status }}</span>
            </div>
        </div>
        <div class="card-body d-sm-flex align-items-sm-center justify-content-sm-between flex-sm-wrap">
            <div class="d-flex align-items-center mb-3 mb-sm-0">
                <div class="ms-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">{{ $order->shop->name }}</h5>
                    </div>
                    <span class="d-inline-block bg-success rounded-pill p-1 me-1"></span>
                    <span class="text-muted">Order Number: {{ $order->order_number }}</span>
                </div>
            </div>

            <div class="d-flex align-items-center mb-3 mb-sm-0">
                <div class="ms-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">{{ $order->worker->name }}</h5>
                    </div>
                    <span class="d-inline-block bg-danger rounded-pill p-1 me-1"></span>
                    <span class="text-muted">Receive Date: {{ date('d M Y', $order->issue_date) }}</span>
                </div>
            </div>
            @if($order->status =='Pending')
            <div>
                <a href="#" class="btn btn-indigo" data-bs-toggle="modal" data-bs-target="#addItem">
                    <i class="ph-plus me-2"></i>
                    Add Item
                </a>
            </div>
            @else
                <div class="d-flex align-items-center mb-3 mb-sm-0">
                    <div class="ms-3">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">{{ $order->status }}</h5>
                        </div>
                        <span class="d-inline-block bg-success rounded-pill p-1 me-1"></span>
                        <span class="text-muted">Posted By: {{ $order->editor->name }}</span>
                    </div>
                </div>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Plan Quantity</th>
                        <th>Product Quantity</th>
                        <th>Rate / per item</th>
                        <th>Amount</th>
                        @if($order->status !='Received')
                        <th class="text-center" style="width: 20px;">
                            <i class="ph-dots-three"></i>
                        </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($total = 0)
                    @foreach($order->receiveItems as $item)
                    <tr>
                        <td>{{ $item->saleItem->name }}</td>
                        <td>{{ $item->plan_quantity }}</td>
                        <td>{{ $item->product_quantity }}</td>
                        <td>{{ $item->rate }}</td>
                        <td>
                            @php($amount=$item->product_quantity*$item->rate)
                            <h6 class="mb-0">{{ number_format($amount) }}</h6>
                            @php($total += $amount)
                        </td>
                        @if($order->status !='Received')
                        <td class="text-center">
                            <div class="d-inline-flex">
                                <a href="#" class="btn btn-sm text-primary" data-bs-toggle="modal" data-bs-target="#editItem{{$item->id}}">
                                    <i class="ph-pen"></i>
                                </a>
                                <form action="{{ route('order.receive.items.destroy',$item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-danger mx-2 sa-confirm">
                                        <span><i class="ph-trash"></i></span>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @include('production.order.receive-item.edit')
                    @endforeach
                    <tr class="table-light">
                        <td colspan="{{ $order->status !='Received' ? '5': '4'}}">Total</td>
                        <td class="text-end">
                            <h6 class="mb-0">{{ number_format($total) }}</h6>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('production.order.receive-item.create')
@endsection

@section('script')
<script>
    $(function () {
        $(".select").select2({ dropdownParent: $("#addItem") });
        $('.validate').validate({
            errorClass: 'validation-invalid-label',
            successClass: 'validation-valid-label',
            validClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
                $(element).addClass('is-invalid');
                $(element).removeClass('is-valid');
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            },
            success: function(label) {
                label.addClass('validation-valid-label').text('Success.');
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }else if (element.parents().hasClass('form-control-feedback') || element.parents().hasClass('form-check') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                }else {
                    error.insertAfter(element);
                }
            }
        });
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
        $(".sa-receive").click(function (event) {
            event.preventDefault();
            swalInit.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, receive it!',
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