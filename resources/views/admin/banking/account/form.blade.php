<div class="row">
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('bank') }}
        {{ Form::select('bank_id', banks(), $account->bank_id, ['class' => 'form-control form-select' . ($errors->has('bank_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('bank_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('title') }}
        {{ Form::text('title', $account->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title','required']) }}
        {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('number') }}
        {{ Form::number('number', $account->number, ['class' => 'form-control' . ($errors->has('number') ? ' is-invalid' : ''), 'placeholder' => 'Number','required']) }}
        {!! $errors->first('number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('balance') }}
        {{ Form::number('balance', $account->balance, ['class' => 'form-control' . ($errors->has('balance') ? ' is-invalid' : ''), 'placeholder' => 'Balance','required','min'=>'0', $account->balance > 0 ? 'disabled' : '']) }}
        {!! $errors->first('balance', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-md-12 mb-3">
        <div class="form-check form-switch">
            <input type="checkbox" class="form-check-input form-check-input-success" id="default" name="default" value="Yes" {{$account->default ? 'Checked' : ''}}>
            <label class="form-check-label" for="default">Default</label>
        </div>
    </div>
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            Submit <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>
