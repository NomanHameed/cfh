@extends('admin.layouts.app')

@section('title')
    {{ $recipe->name ?? "{{ __('Show') Recipe" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Recipe Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('recipes.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} {{ $recipe->recipe_number }}</h5>
            <div class="d-inline-flex ms-auto">
                <span class="badge bg-success rounded-pill">{{ $recipe->status }}</span>
            </div>
        </div>
        <div class="card-body  d-sm-flex align-items-sm-center justify-content-sm-between flex-sm-wrap">
            <div class="d-flex align-items-center mb-3 mb-sm-0">
                <div class="ms-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">{{ $recipe->recipeName->name }}</h5>
                    </div>
                    <span class="d-inline-block bg-success rounded-pill p-1 me-1"></span>
                    <span class="text-muted">Recipe Quantity: {{ $recipe->quantity }}</span>
                </div>
            </div>

            <div>
                <a href="#" class="btn btn-indigo" data-bs-toggle="modal" data-bs-target="#addRecipeItem">
                    <i class="ph-plus me-2"></i>
                    Add Item
                </a>
            </div>
            @include('admin.production.recipe-issue-item.create')

        </div>

        <div class="table-responsive">
            <table class="table datatable-basic">
                <thead class="thead">
                <tr>
                    <th>No</th>

                    <th>Purchase Item Id</th>
                    <th>Quantity</th>

                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($recipe->recipeIssueItems as $key => $recipeIssueItem)
                    <tr>
                        <td>{{ ++$key }}</td>

                        <td>{{ $recipeIssueItem->purchaseItem->name }}</td>
                        <td>{{ $recipeIssueItem->quantity }}</td>

                        <td class="text-center">
                            @include('admin.production.recipe-issue-item.edit')
                            @include('admin.production.recipe-issue-item.actions')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


