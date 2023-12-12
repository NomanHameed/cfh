@extends('admin.layouts.app')

@section('title')
    {{ $order->name ?? "Show Order" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Order Managment</span>
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
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="mb-0">{{ __('Show') }} Order</h5>
            <div class="d-inline-flex ms-auto">
                <span class="badge bg-success rounded-pill">{{ $order->status }}</span>
            </div>
        </div>
        <div class="card-body d-sm-flex align-items-sm-center justify-content-sm-between flex-sm-wrap">
            <div class="d-flex align-items-center mb-3 mb-sm-0">
                <div class="ms-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">Issue Stock Items</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Lenght(MM)</th>
                        <th>Width(MM)</th>
                        <th>Thikness(MM)</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @php($total = 0)
                    @foreach($order->issueItems as $item)
                    <tr>
                        <td>{{ $item->purchaseItem->name }}</td>
                        <td><span class="text-muted">{{ $item->purchaseItem->length }}</span></td>
                        <td><span class="text-muted">{{ $item->purchaseItem->width }}</span></td>
                        <td><span class="text-muted">{{ $item->purchaseItem->thikness }}</span></td>
                        <td>
                            <h6 class="mb-0">{{ number_format($item->quantity) }}</h6>
                            @php($total += $item->quantity)
                        </td>
                    </tr>
                    @endforeach
                    <tr class="table-light">
                        <td colspan="4">Total</td>
                        <td class="text-end">
                            <h6 class="mb-0">{{ number_format($total) }}</h6>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-body d-sm-flex align-items-sm-center justify-content-sm-between flex-sm-wrap">
            <div class="d-flex align-items-center mb-3 mb-sm-0">
                <div class="ms-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">Plan Stock Items</h5>
                    </div>
                </div>
            </div>
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
                    </tr>
                    @endforeach
                    <tr class="table-light">
                        <td colspan="4">Total</td>
                        <td class="text-end">
                            <h6 class="mb-0">{{ number_format($total) }}</h6>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
