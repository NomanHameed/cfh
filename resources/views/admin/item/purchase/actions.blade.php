@canany(['purchaseItems-view', 'purchaseItems-edit', 'purchaseItems-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('purchase-items.destroy',$purchaseItem->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('purchaseItems-view')
                    <a href="{{ route('purchase-items.show',$purchaseItem->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('purchaseItems-edit')
                    <a href="{{ route('purchase-items.edit',$purchaseItem->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('purchaseItems-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany