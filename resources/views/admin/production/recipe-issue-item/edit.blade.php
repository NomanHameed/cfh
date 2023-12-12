<div id="addRecipeItem{{$recipeIssueItem->id}}" class="modal fade" tabindex="-1">

    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('recipe-issue-items.update', $recipeIssueItem->id) }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="modal-header">
                    <h5 class="modal-title">Update Order Issue Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('purchase_item_id') }}
                            {{ Form::select('purchase_item_id', purchaseItems(), $recipeIssueItem->purchase_item_id , ['class' => 'form-control form-select' . ($errors->has('purchase_item_id') ? ' is-invalid' : ''), 'placeholder' => 'Purchase Item Id','required']) }}
                            {!! $errors->first('purchase_item_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('quantity') }}
                            {{ Form::text('quantity', $recipeIssueItem->quantity, ['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''), 'placeholder' => 'Quantity','required']) }}
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
