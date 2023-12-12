@canany(['saleIngredients-view', 'saleIngredients-edit', 'saleIngredients-delete'])
    <div class="d-inline-flex">
        <div class="dropdown">
            <a href="#" class="text-body" data-bs-toggle="dropdown">
                <i class="ph-list"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <form action="{{ route('sale-ingredients.destroy',$recipeItem->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @can('saleIngredients-delete')
                        <button type="submit" class="dropdown-item sa-confirm">
                            <i class="ph-trash me-2"></i>{{ __('Delete') }}
                        </button>
                    @endcan
                </form>
            </div>
        </div>
    </div>
@endcanany
