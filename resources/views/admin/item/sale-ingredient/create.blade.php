<div id="addSaleIngredient" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('sale-ingredients.store') }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Order Issue Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('sale_item_id', $saleItem->id) }}
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('type') }}
                            {{ Form::select('type', ['Recipe' => 'Recipe', 'Purchase Item' => 'Purchase Item'], null , ['class' => 'form-control select' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => '--Select--' , 'id' => 'type']) }}
                            {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-12 mb-3 recipe" style="display: none">
                            {{ Form::label('Recipe') }}
                            {{ Form::select('parent_id_sale', recipieNames(), null , ['class' => 'form-control select-form' . ($errors->has('parent_id') ? ' is-invalid' : ''), 'placeholder' => 'Recipe', 'id' => 'recipeinput']) }}
                            {!! $errors->first('parent', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-12 mb-3 purchaseItems" style="display: none">
                            {{ Form::label('Product Item') }}
                            {{ Form::select('parent_id_purchase', purchaseItems(), null , ['class' => 'form-control select-form' . ($errors->has('parent_id') ? ' is-invalid' : ''), 'placeholder' => 'Product Item', 'id' => 'purchaseItemsinput']) }}
                            {!! $errors->first('parent_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('quantity') }}
                            {{ Form::text('quantity', null, ['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''), 'placeholder' => 'Quantity','required']) }}
                            {!! $errors->first('quantity', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
