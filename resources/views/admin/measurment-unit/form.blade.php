<div class="row">
      
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('name') }}
        {{ Form::text('name', $measurmentUnit->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('minimum_value') }}
        {{ Form::text('minimum_value', $measurmentUnit->minimum_value, ['class' => 'form-control' . ($errors->has('minimum_value') ? ' is-invalid' : ''), 'placeholder' => 'Minimum Value','required']) }}
        {!! $errors->first('minimum_value', '<div class="invalid-feedback">:message</div>') !!}
    </div>

      <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
            <button type="submit" class="btn btn-primary ms-3">
                Submit <i class="ph-paper-plane-tilt ms-2"></i>
            </button>
      </div>
</div>
