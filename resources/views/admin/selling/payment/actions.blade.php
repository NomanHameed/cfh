@canany(['salePayments-view', 'salePayments-edit', 'salePayments-delete'])
    <div class="d-inline-flex">
        <div class="dropdown">
            <a href="#" class="text-body" data-bs-toggle="dropdown">
                <i class="ph-list"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <form action="{{ route('sale-payments.destroy',$salePayment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @can('salePayments-view')
                        <a href="{{ route('sale-payments.show',$salePayment->id) }}" class="dropdown-item">
                            <i class="ph-eye me-2"></i>{{ __('Show') }}
                        </a>
                    @endcan
                    @can('salePayments-edit')
                        <a href="{{ route('sale-payments.edit',$salePayment->id) }}" class="dropdown-item">
                            <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                        </a>
                    @endcan
                    @can('salePayments-delete')
                        <button type="submit" class="dropdown-item sa-confirm">
                            <i class="ph-trash me-2"></i>{{ __('Delete') }}
                        </button>
                    @endcan
                </form>
            </div>
        </div>
    </div>
@endcanany
