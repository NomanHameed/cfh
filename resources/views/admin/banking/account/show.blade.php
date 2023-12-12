@extends('admin.layouts.app')

@section('title')
    {{ $account->name ?? "Show Account" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Account Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('accounts.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Account</h5>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <strong>Bank:</strong>
                {{ $account->bank->title }}
            </div>
            <div class="form-group mb-3">
                <strong>Title:</strong>
                {{ $account->title }}
            </div>
            <div class="form-group mb-3">
                <strong>Number:</strong>
                {{ $account->number }}
            </div>
            <div class="form-group mb-3">
                <strong>Balance:</strong>
                {{ number_format($account->balance) }}
            </div>
            <div class="form-group mb-3">
                <strong>Default:</strong>
                {{ $account->default }}
            </div>
            <div class="form-group mb-3">
                <strong>Created By:</strong>
                {{ $account->creator?->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Updated By:</strong>
                {{ $account->editor?->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Deleted By:</strong>
                {{ $account->remover?->name }}
            </div>
        </div>
    </div>
</div>
@endsection
