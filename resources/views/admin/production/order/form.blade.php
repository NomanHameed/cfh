<div class="row">
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('shop') }}
        {{ Form::select('shop_id', shops(), $order->shop_id, ['class' => 'form-control select' . ($errors->has('shop_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('shop_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('worker') }}
        {{ Form::select('worker_id', workers(), $order->worker_id, ['class' => 'form-control select' . ($errors->has('worker_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('worker_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('issue_date') }}
        {{ Form::text('issue_date', $order->issue_date, ['class' => 'form-control datepicker-autohide' . ($errors->has('issue_date') ? ' is-invalid' : ''), 'placeholder' => 'Issue Date','required']) }}
        {!! $errors->first('issue_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('receive_date') }}
        {{ Form::text('receive_date', $order->receive_date, ['class' => 'form-control receive_date' . ($errors->has('receive_date') ? ' is-invalid' : ''), 'placeholder' => 'Receive Date','required']) }}
        {!! $errors->first('receive_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>