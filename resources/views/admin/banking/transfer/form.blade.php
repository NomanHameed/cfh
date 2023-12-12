<div class="row">
      
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('from_account') }}
        {{ Form::select('from_account', accounts(), $transfer->from_account, ['class' => 'form-control form-select' . ($errors->has('from_account') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required','id'=>'from_account']) }}
        {!! $errors->first('from_account', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('to_account') }}
        {{ Form::select('to_account', accounts(), $transfer->to_account, ['class' => 'form-control form-select' . ($errors->has('to_account') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('to_account', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('date') }}
        {{ Form::text('date', $transfer->date, ['class' => 'form-control datepicker-autohide' . ($errors->has('date') ? ' is-invalid' : ''), 'placeholder' => 'Pick a Date','required']) }}
        {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('amount') }}
        {{ Form::number('amount', $transfer->amount, ['class' => 'form-control' . ($errors->has('amount') ? ' is-invalid' : ''), 'placeholder' => 'Amount','required','min' => '0']) }}
        {!! $errors->first('amount', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-12 mb-3">
        {{ Form::label('description') }}
        {{ Form::text('description', $transfer->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            Submit <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>
