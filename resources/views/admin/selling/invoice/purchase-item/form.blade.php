<div class="row">
	
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('invoice_id') }}
        {{ Form::text('invoice_id', $invoicePurchaseItem->invoice_id, ['class' => 'form-control' . ($errors->has('invoice_id') ? ' is-invalid' : ''), 'placeholder' => 'Invoice Id','required']) }}
        {!! $errors->first('invoice_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('purchase_item_id') }}
        {{ Form::text('purchase_item_id', $invoicePurchaseItem->purchase_item_id, ['class' => 'form-control' . ($errors->has('purchase_item_id') ? ' is-invalid' : ''), 'placeholder' => 'Purchase Item Id','required']) }}
        {!! $errors->first('purchase_item_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('description') }}
        {{ Form::text('description', $invoicePurchaseItem->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description','required']) }}
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('quantity') }}
        {{ Form::text('quantity', $invoicePurchaseItem->quantity, ['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''), 'placeholder' => 'Quantity','required']) }}
        {!! $errors->first('quantity', '<div class="invalid-feedback">:message</div>') !!}
    </div>    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('rate') }}
        {{ Form::text('rate', $invoicePurchaseItem->rate, ['class' => 'form-control' . ($errors->has('rate') ? ' is-invalid' : ''), 'placeholder' => 'Rate','required']) }}
        {!! $errors->first('rate', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>