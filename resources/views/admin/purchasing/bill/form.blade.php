<div class="row">
    <div class="form-group col-lg-4">
        {{ Form::label('vendor') }}
        {{ Form::select('vendor_id', vendors(), $bill->vendor_id, ['class' => 'form-control select' . ($errors->has('vendor_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('vendor_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4">
        {{ Form::label('bill_date') }}
        {{ Form::text('bill_date', $bill->bill_date, ['class' => 'form-control datepicker-autohide' . ($errors->has('bill_date') ? ' is-invalid' : ''), 'placeholder' => 'Bill Date','required']) }}
        {!! $errors->first('bill_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4">
        {{ Form::label('due_date') }}
        {{ Form::text('due_date', $bill->due_date, ['class' => 'form-control due-date' . ($errors->has('due_date') ? ' is-invalid' : ''), 'placeholder' => 'Due Date','required']) }}
        {!! $errors->first('due_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>