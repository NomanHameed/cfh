@canany(['saleItems-view', 'saleItems-edit', 'saleItems-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('sale-items.destroy',$saleItem->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('saleItems-view')
                    <a href="{{ route('sale-items.show',$saleItem->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('saleItems-view')
                    <a href="{{ route('sale-ingredients.show',$saleItem->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Add Ingredients') }}
                    </a>
                @endcan
                @can('saleItems-edit')
                    <a href="{{ route('sale-items.edit',$saleItem->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('saleItems-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany
