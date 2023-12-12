@extends('admin.layouts.app')

@section('title')
    {{ $transaction->name ?? "Show Transaction" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Transaction Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('transactions.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Transaction</h5>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <strong>Transaction:</strong>
                {{ $transaction->transaction_id }}
            </div>
            <div class="form-group mb-3">
                <strong>Date:</strong>
                {{ date('Y-m-d', $transaction->date) }}
            </div>
            <div class="form-group mb-3">
                <strong>Type:</strong>
                {{ $transaction->type }}
            </div>
            <div class="form-group mb-3">
                <strong>Category:</strong>
                {{ $transaction->category }}
            </div>
            <div class="form-group mb-3">
                <strong>Account:</strong>
                {{ $transaction->account->title }}
            </div>
            <div class="form-group mb-3">
                <strong>Amount:</strong>
                {{ number_format($transaction->amount) }}
            </div>
            <div class="form-group mb-3">
                <strong>Created By:</strong>
                {{ $transaction->creator->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Updated By:</strong>
                {{ $transaction->editor->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Deleted By:</strong>
                {{ $transaction->remover?->name }}
            </div>
        </div>
    </div>
</div>
@endsection
