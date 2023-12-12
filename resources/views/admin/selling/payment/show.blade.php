@extends('admin.layouts.app')

@section('title')
    {{ $salePayment->name ?? "Show Sale Payment" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Sale Payment Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('sale-payments.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
        <div class="card-header">
            <h5 class="mb-0">{{ __('Show') }} Sale Payment</h5>
        </div>
        <div class="card-body">

                        <div class="form-group mb-3">
                            <strong>Customer Id:</strong>
                            {{ $salePayment->customer_id }}
                        </div>                        <div class="form-group mb-3">
                            <strong>Date:</strong>
                            {{ $salePayment->date }}
                        </div>                        <div class="form-group mb-3">
                            <strong>Amount:</strong>
                            {{ $salePayment->amount }}
                        </div>
        </div>
    </div>
</div>
@endsection
