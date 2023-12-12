<div class="row">
    <div class="col-6">
        <div class="row">
            <div class="form-group col-lg-6 mb-3">
                {{ Form::label('customer') }}
                {{ Form::select('customer_id', customers(), $invoice->customer_id, ['class' => 'form-control select' . ($errors->has('customer_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                {!! $errors->first('customer_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-lg-6 mb-3">
                {{ Form::label('invoice_date') }}
                {{ Form::text('invoice_date', $invoice->invoice_date, ['class' => 'form-control datepicker-autohide' . ($errors->has('invoice_date') ? ' is-invalid' : ''), 'placeholder' => 'Invoice Date','required']) }}
                {!! $errors->first('invoice_date', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
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
        <div class="row">
            <div class="form-group col-lg-4 mb-3">
                {{ Form::label('Order Type') }}
                {{ Form::select('order_type', ['Takeaway'=>'Takeaway','Delivery'=>'Delivery'], $invoice->order_type, ['class' => 'form-control select' . ($errors->has('order_type') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                {!! $errors->first('order_type', '<div class="invalid-feedback">:message</div>') !!}
            </div>
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
            <div class="form-group col-lg-6 mb-3">
                {{ Form::label('Payment') }}
                {{ Form::number('payment', $invoice->payment, ['class' => 'form-control datepicker-autohide' . ($errors->has('payment') ? ' is-invalid' : ''), 'placeholder' => 'Payment', 'id'=>'payment']) }}
                {!! $errors->first('payment', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    </div>
    <div class="col-6">
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

            </tbody>
            <tfoor>
                <td colspan="4"><h5>Total Amount</h5></td>
                <td><h5 id="totalamount">0</h5></td>
            </tfoor>
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
