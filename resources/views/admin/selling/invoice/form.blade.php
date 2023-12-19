<div class="row">
    <div class="col-6">
        <div class="row">
            <div class="form-group col-lg-12 mb-3">
                {{ Form::select('customer_id', [], Null, ['class' => 'form-control select-remote-data' . ($errors->has('customer_id') ? ' is-invalid' : ''), 'placeholder' => '--Select Customer--','required']) }}
                {!! $errors->first('customer_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6 mb-3">
                {{ Form::label('invoice_date') }}
                <input type="text" class="form-control datepicker-autohide" name="invoice_date" value="{{$invoice->invoice_date ?? date('m/d/Y')}}" required>
                {{-- {{ Form::text('invoice_date', ($invoice->invoice_date) ? $invoice->invoice_date : now(), ['class' => 'form-control datepicker-autohide' . ($errors->has('invoice_date') ? ' is-invalid' : ''), 'placeholder' => 'Invoice Date','required']) }} --}}
                {!! $errors->first('invoice_date', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-lg-6 mb-3">
                {{ Form::label('Order Type') }}
                {{ Form::select('order_type', ['Takeaway'=>'Takeaway','Delivery'=>'Delivery'], $invoice->order_type, ['class' => 'form-control select' . ($errors->has('order_type') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                {!! $errors->first('order_type', '<div class="invalid-feedback">:message</div>') !!}
            </div>

        </div>

        <div class="row">
            <div class="form-group col-lg-4 mb-3">
                {{ Form::label('Payment Type') }}
                {{ Form::select('payment_type', ['Cash' => 'Cash','Pending'=>'Pending','Transfer'=>'Transfer'], $invoice->payment_type, ['class' => 'form-control select' . ($errors->has('payment_type') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required', 'id'=> 'payment_type']) }}
                {!! $errors->first('payment_type', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-lg-4 mb-3">
                {{ Form::label('Account') }}
                {{ Form::select('account_id', accounts() , $invoice->account_id, ['class' => 'form-control' . ($errors->has('account_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--',  'id'=>'account_id']) }}
                {!! $errors->first('account_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-lg-4 mb-3">
                {{ Form::label('Payment') }}
                {{ Form::number('payment', $invoice->payment, ['class' => 'form-control' . ($errors->has('payment') ? ' is-invalid' : ''), 'placeholder' => 'Payment', 'id'=>'payment']) }}
                {!! $errors->first('payment', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="form-group col-lg-6 mb-3">
                <select name="product_id" id="product_id" class='form-control select' . {{($errors->has('product_id') ? '
            is-invalid' : '')}} required>
                    <option>Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-rate="{{ $product->price }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                {!! $errors->first('product_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-lg-2 mb-3">
                <input type="text" name="quantity" id="quantity" class='form-control' . {{($errors->has('quantity') ? '
            is-invalid' : '')}}  placeholder='Quantity' min="1">
                {!! $errors->first('quantity', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-lg-2 mb-3">
                <input type="text" name="rate" id="rate" class='form-control' . {{($errors->has('rate') ? '
            is-invalid' : '')}}  placeholder='Rate' min="1">
                {!! $errors->first('rate', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-lg-1">
                <button type="button" name="add" id="add-btn" class="btn btn-success">Add</button>
            </div>
        </div>
        <table class="table table-bordered" >
            <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody id="dynamicAddRemove">
                @if($invoice->InvoiceItems)
                    @foreach ($invoice->InvoiceItems as $key => $item)
                    <tr>
                        <td>
                            <input type="hidden" value="{{ $item->id }}" name="moreFields[{{ $key }}][product_id]" class="form-control" />
                            <input type="text" name="moreFields[{{ $key }}][sale_item_name]" value="{{ $item->saleItem->name }}" class="form-control pe-none" />
                        </td>
                        <td>
                            <input type="text" value="{{ $item->quantity }}" name="moreFields[{{ $key }}][quantity]"  class="form-control pe-none"   />
                        </td>
                        <td>
                            <input type="text" value="{{ $item->rate }}" name="moreFields[{{ $key }}][rate]"  class="form-control pe-none" />
                        </td>
                        <td>{{ $item->quantity * $item->rate }}</td>
                        <td>
                            <button type="button" class="btn btn-danger remove-tr">Remove</button>
                        </td>
                    </tr>
                    @endforeach

                @endif


            </tbody>
            <tfoot>
                <td colspan="4"><h5>Total Amount</h5></td>
                <td><h5 id="totalamount">0</h5></td>
            </tfoot>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            Submit <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>


@push('scripts')
<script>
    $(function(){

        $("#product_id").select2();
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
            // success: function(label) {
            //     label.addClass('validation-valid-label').text('Success.');
            // },
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
        const dpAutoHideElement = document.querySelector('.due_date');
        if(dpAutoHideElement) {
            const dpAutoHide = new Datepicker(dpAutoHideElement, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                autohide: true
            });
        }
        var i = 0;
        var total = 0;

        $("#add-btn").click(function(){
            if($('#product_id').val() == 'Select Product'){
                alert($('#product_id').val());
                return;
            }
            ++i;
            var item_id = $('#product_id').val();
            var item_text = $('#product_id option:selected').text();
            var quantity = $('#quantity').val();
            var rate = $('#rate').val();


            $("#dynamicAddRemove").append('<tr><td><input type="hidden" value="'+ item_id +'" name="moreFields['+i+'][product_id]" class="form-control" /><input type="text" name="moreFields['+i+'][sale_item_name]" value="'+ item_text +'" class="form-control pe-none" /></td><td><input type="text" value="'+ quantity +'" name="moreFields['+i+'][quantity]"  class="form-control pe-none"   /></td><td><input type="text" value="'+ rate +'" name="moreFields['+i+'][rate]"  class="form-control pe-none" /></td><td>'+ quantity * rate +'</td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
            total += quantity*rate;
            $('#totalamount').text(total);

            $('#product_id').val('Select Product').trigger("change");
            $('#quantity').val('');
            $('#rate').val('');
        });
        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });

        $('#product_id').change(function() {
            var selectedOption = $(this).find('option:selected');
            var customValue = selectedOption.data('rate');
            $('#rate').val(customValue);
        });

        $('#payment_type').change(function() {

            if($('#payment_type').val() == 'Pending'){
                $('#account_id').prop('disabled', true);
                $('#payment').prop('readonly', true);
            }else{
                $('#account_id').prop('disabled', false);
                $('#payment').prop('readonly', false);
            }

            // var selectedOption = $(this).find('option:selected');
            // var customValue = selectedOption.data('rate');
            // $('#rate').val(customValue);
        });



        function formatRepo (repo) {
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
        function formatRepoSelection (repo) {
            return repo.name || repo.text;
        }
        $('.select-remote-data').select2({
            // dropdownParent: $("#addMember"),
            ajax: {
                url: "{{route('customers.search')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function (responce, params) {
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
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 1,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection
        });
    });



</script>

@endpush
