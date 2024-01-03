@extends('admin.layouts.app')

@section('title')
    POS
@endsection

@section('header')
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Home - <span class="fw-normal">POS</span>
            </h4>
        </div>
        <div class="d-lg-block my-lg-auto ms-lg-auto">
            <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
                <a href="{{ route('invoices.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
    <div class="col-sm-7">
        <div class="form-group mb-3">
            <input type="text" class="form-control w-100" placeholder="Search Items" id="product-items-search">
        </div>
        <div class="row" style="max-height: 70vh; overflow-y: auto">
            @foreach ($products as $product)
                <div class="col-2 products-wraper" data-title="{{ $product->name }}">
                    <div class="card">
                        <div class="p-2 d-flex justify-content-center align-items-center product-items"
                            data-name="{{ $product->name }}" data-id="{{ $product->id }}"
                            data-price="{{ $product->price }}">
                            @if (isset($product->image))
                                <img src="{{ $product->image }}" alt="">
                            @else
                                <h5 class="text-center word-break">
                                    {{ $product->name }}
                                </h5>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>

    <div class="col-sm-5">
        <form method="POST" action="{{ route('invoices.store') }}" class="validate" role="form"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $invoice->id ?? '' }}" name="invoice_id">
            <div class="card">

                <div class="card-body">
                    <div class="form-group mb-2">
                        {{ Form::select('customer_id', [], null, ['class' => 'form-control select-remote-data' . ($errors->has('customer_id') ? ' is-invalid' : ''), 'placeholder' => '--Select Customer--', 'required']) }}
                        {!! $errors->first('customer_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::select('payment_type', ['Cash' => 'Cash', 'Pending' => 'Pending', 'Transfer' => 'Transfer'], $invoice->payment_type, ['class' => 'form-control select' . ($errors->has('payment_type') ? ' is-invalid' : ''), 'placeholder' => '--Select Invoice Type--', 'required', 'id' => 'payment_type']) }}
                        {!! $errors->first('payment_type', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>


                <table class="table table-bordered table-sm" id="order-table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="dynamicAddRemove">
                        @if ($invoice->InvoiceItems)
                            @php
                                $grandTotal = 0;
                            @endphp
                            @foreach ($invoice->InvoiceItems as $item)
                                {{-- @dd($item) --}}
                                <tr id="product-item-{{ $item->sale_item_id }}">
                                    <td>
                                        <input type="hidden" value="{{ $item->sale_item_id }}"
                                            name="moreFields[{{ $item->sale_item_id }}][product_id]" />
                                        {{ $item->saleItem->name }}
                                    </td>
                                    <td>
                                        <input type="text" value="{{ $item->quantity }}"
                                            name="moreFields[{{ $item->sale_item_id }}][quantity]"
                                            class="form-control product-quantity" />
                                    </td>
                                    <td>
                                        <input type="text" value="{{ $item->rate }}"
                                            name="moreFields[{{ $item->sale_item_id }}][rate]"
                                            class="form-control product-price" />
                                    </td>
                                    <td class="product-amount">{{ $grandTotal += $item->quantity * $item->rate }}</td>
                                    <td>
                                        <button type="button" class="btn btn-link text-danger remove-tr"><i
                                                class="ph-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <td colspan="4">
                            <h5 class="m-0">Total Amount</h5>
                        </td>
                        <td>
                            <h5 class="m-0" id="totalAmount">{{ $grandTotal }}</h5>
                        </td>
                    </tfoot>
                </table>

                <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center py-sm-2">
                    <button type="reset" class="btn btn-light w-100 w-sm-auto">Reset</button>
                    <button type="submit" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto submit-form">Submit</button>
                </div>

            </div>
        </form>
    </div>
@endsection

@section('script')
    <style>
        .product-items {
            height: 120px;
            cursor: pointer;
        }
    </style>
    <script>

        $(document).ready(function() {
            let $searchBox = $('#product-items-search');
            let $productCards = $('.products-wraper');
            $searchBox.val('');

            $searchBox.on('input', function() {
                let searchTerm = $searchBox.val().toLowerCase();
                $productCards.each(function() {
                    let $this = $(this);
                    $this.hide();

                    if ($this.data('title').toLowerCase().includes(searchTerm)) {
                        $this.show();
                    }
                });
            });
        });
    </script>
    <script>
        $(function() {
            $('.product-items').on('click', function() {
                const productId = $(this).data('id');
                const productPrice = Number($(this).data('price'));
                const data = {
                    id: productId,
                    quantity: 1,
                    name: $(this).data('name'),
                    price: productPrice,
                    amount: productPrice,
                };
                const $existingRow = $(`#product-item-${productId}`);

                if ($existingRow.length) {
                    const $quantityInput = $existingRow.find('.product-quantity');
                    const quantity = Number($quantityInput.val()) + 1;
                    $quantityInput.val(quantity);

                    const price = $existingRow.find('.product-price').val();
                    updateAmount($quantityInput, quantity, price);
                } else {
                    $('#order-table tbody').append(orderSingleRow(data));
                }

                updateTotal();

            });

            // Remove Row
            $('#order-table').on('click', '.remove-tr', function() {
                $(this).closest('tr').remove();
                updateTotal();
            });

            $(document).on('input', '.product-quantity', function() {
                let quantity = $(this).val();
                let price = $(this).closest('tr').find('.product-price').val();
                updateAmount(this, quantity, price);
                updateTotal();
            });

            $(document).on('input', '.product-price', function() {
                let price = $(this).val();
                let quantity = $(this).closest('tr').find('.product-quantity').val();
                updateAmount(this, quantity, price);
                updateTotal();
            });

            function updateAmount(element, quantity, price) {
                let amount = 0;
                if (price && quantity) {
                    amount = parseFloat(quantity) * parseFloat(price);
                }
                $(element).closest('tr').find('.product-amount').text(amount.toFixed(2));
            }

            updateTotal();
            function updateTotal() {
                let totalAmount = 0;
                $('.product-amount').each((i, obj) => {
                    totalAmount += parseFloat($(obj).text());
                });
                const formButton = $('.submit-form');
                totalAmount < 1 ? formButton.addClass('disabled') : formButton.removeClass('disabled');

                $('#totalAmount').text(totalAmount);
            }

            function orderSingleRow(data) {
                return `
                <tr id="product-item-${data.id}">
                    <td>
                        <input type="hidden" value="${data.id}" name="moreFields[${data.id}][product_id]"/>
                        ${data.name}
                    </td>
                    <td>
                        <input type="number" value="${data.quantity}" name="moreFields[${data.id}][quantity]" class="form-control product-quantity" min="0" step="0.01"/>
                    </td>
                    <td>
                        <input type="number" value="${data.price}" name="moreFields[${data.id}][rate]" class="form-control product-price" min="0"/>
                    </td>
                    <td class="product-amount">${data.amount.toFixed(2)}</td>
                    <td>
                        <button type="button" class="btn btn-link text-danger remove-tr"><i class="ph-trash"></i></button>
                    </td>
                </tr>`;
            }
        });
    </script>
    <script>
        $(function() {
            function formatRepo(repo) {
                if (repo.loading) return repo.text;
                const markup = `
                <div class="select2-result-repository clearfix">
                    <div class="select2-result-repository__avatar"><img src="${repo.image}" /></div>
                    <div class="select2-result-repository__meta">
                        <div class="select2-result-repository__title">${repo.name}</div>
                        <div class="select2-result-repository__description">${repo.email}</div>
                    </div>
                    <div class="select2-result-repository__statistics">
                        <div class="select2-result-repository__forks">Mobile #: ${repo.phone}</div>
                    </div>
                </div>
            `;
                return markup;
            }

            function formatRepoSelection(repo) {
                return repo.name || repo.text;
            }
            $('.select-remote-data').select2({
                // dropdownParent: $("#addMember"),
                ajax: {
                    url: "{{ route('customers.search') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                            page: params.page
                        };
                    },
                    processResults: function(responce, params) {
                        params.page = params.page || 1;
                        return {
                            results: responce.data,
                            pagination: {
                                more: (params.page * 10) < responce.total
                            }
                        };
                    },
                    cache: true
                },
                escapeMarkup: function(markup) {
                    return markup;
                },
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });
        });
    </script>
@endsection
