@canany(['purchasePayments-view', 'purchasePayments-edit', 'purchasePayments-delete'])
    <div class="d-inline-flex">
        <div class="dropdown">
            <a href="#" class="text-body" data-bs-toggle="dropdown">
                <i class="ph-list"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end">

                @can('purchasePayments-view')
                    <a href="{{ route('purchase-payments.show',$purchasePayment->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan

                @if($purchasePayment->status !='approved')
                    @can('purchasePayments-edit')
                        <a href="{{ route('purchase-payments.edit',$purchasePayment->id) }}" class="dropdown-item">
                            <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                        </a>
                    @endcan
                    @can('purchasePayments-publish')
                        <form method="POST" action="{{ route('purchase-payments.publish', $purchasePayment->id) }}">
                            @csrf
                            {{ method_field('PATCH') }}
                            <button type="submit" class="dropdown-item sa-post">
                                <i class="ph-fast-forward-circle me-2"></i>{{ __('Post') }}
                            </button>
                        </form>
                    @endcan
                @endif

                @can('purchasePayments-delete')
                    <form action="{{ route('purchase-payments.destroy',$purchasePayment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item sa-confirm">
                            <i class="ph-trash me-2"></i>{{ __('Delete') }}
                        </button>

                    </form>
                @endcan
            </div>
        </div>
    </div>
@endcanany
