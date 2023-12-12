<div class="row">
	
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('invoice_id') }}
        {{ Form::text('invoice_id', $invoiceSaleItem->invoice_id, ['class' => 'form-control' . ($errors->has('invoice_id') ? ' is-invalid' : ''), 'placeholder' => 'Invoice Id','required']) }}
        {!! $errors->first('invoice_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('sale_item_id') }}
        {{ Form::text('sale_item_id', $invoiceSaleItem->sale_item_id, ['class' => 'form-control' . ($errors->has('sale_item_id') ? ' is-invalid' : ''), 'placeholder' => 'Sale Item Id','required']) }}
        {!! $errors->first('sale_item_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('quantity') }}
        {{ Form::text('quantity', $invoiceSaleItem->quantity, ['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''), 'placeholder' => 'Quantity','required']) }}
        {!! $errors->first('quantity', '<div class="invalid-feedback">:message</div>') !!}
    </div>    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('rate') }}
        {{ Form::text('rate', $invoiceSaleItem->rate, ['class' => 'form-control' . ($errors->has('rate') ? ' is-invalid' : ''), 'placeholder' => 'Rate','required']) }}
        {!! $errors->first('rate', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>