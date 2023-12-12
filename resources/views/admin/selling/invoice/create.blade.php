@extends('admin.layouts.app')

@section('title')
{{ __('Create') }} Invoice
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Invoice Managment</span>
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
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ __('Create') }} Invoice</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('invoices.store') }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                @include('admin.selling.invoice.form')

            </form>
        </div>

    </div>
</div>
@endsection

@section('script')
<script>
    $(function(){

        $(".select").select2();
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


    });

</script>
@endsection
