@extends('admin.layouts.app')

@section('title')
    {{ $saleItem->name ?? "Show Sale Item" }}
@endsection

@section('header')
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Home - <span class="fw-normal">Sale Item Managment</span>
            </h4>
        </div>
        <div class="d-lg-block my-lg-auto ms-lg-auto">
            <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
                <a href="{{ route('sale-items.index') }}"
                   class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
                <h5 class="mb-0">Add {{ $saleItem->name }} Ingredients</h5>
            </div>

            <div class="card-body  d-sm-flex align-items-sm-center justify-content-sm-between flex-sm-wrap">
                <div class="d-flex align-items-center mb-3 mb-sm-0">
                    <div class="ms-3">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">{{ $saleItem->name }}</h5>
                        </div>
                        <span class="d-inline-block bg-success rounded-pill p-1 me-1"></span>
                        <span class="text-muted">Price: {{ $saleItem->price }}</span>
                    </div>
                </div>

                <div>
                    <a href="#" class="btn btn-indigo" data-bs-toggle="modal" data-bs-target="#addSaleIngredient">
                        <i class="ph-plus me-2"></i>
                        Add Item
                    </a>
                </div>
            </div>
                <div class="table-responsive">
                    <table class="table datatable-basic">
                        <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>Item</th>
                            <th>Quantity</th>

                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($saleItem->saleIngredients as $key => $recipeItem)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    @if ($recipeItem->itemable_type === 'App\Models\Recipe')
                                        {{ $recipeItem->itemable->recipeName->name }}
                                    @elseif ($recipeItem->itemable_type === 'App\Models\PurchaseItem')
                                        {{ $recipeItem->itemable->name }}
                                    @endif
                                </td>
                                <td>{{ $recipeItem->quantity }}</td>

                                <td class="text-center">
                                    @include('admin.item.sale-ingredient.actions')
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


        </div>
    </div>
    @include('admin.item.sale-ingredient.create')
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

            $("#type").change(function(){
                $(this).find("option:selected").each(function(){
                    var optionValue = $(this).attr("value");
                    if(optionValue =='Recipe'){
                        $('div.recipe').show('slow');
                        $("div.purchaseItems").hide('slow');
                        $("#purchaseItemsinput").val(null);
                    }else if(optionValue =='Purchase Item'){
                        $('div.recipe').hide('slow');
                        $("div.purchaseItems").show('slow');
                        $("#recipeinput").val(null);
                    }else{
                        $('div.recipe').hide('slow');
                        $("div.purchaseItems").hide('slow');
                    }
                });
            });
        });
    </script>
@endsection

