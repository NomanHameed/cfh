@canany(['recipeNames-view', 'recipeNames-edit', 'recipeNames-delete'])
    <div class="d-inline-flex">
        <div class="dropdown">
            <a href="#" class="text-body" data-bs-toggle="dropdown">
                <i class="ph-list"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <form action="{{ route('recipe-names.destroy',$recipeName->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @can('recipeNames-view')
                        <a href="{{ route('recipe-names.show',$recipeName->id) }}" class="dropdown-item">
                            <i class="ph-eye me-2"></i>{{ __('Show') }}
                        </a>
                    @endcan
                    @can('recipeNames-edit')
                        <a href="{{ route('recipe-names.edit',$recipeName->id) }}" class="dropdown-item">
                            <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                        </a>
                    @endcan
                    @can('recipeNames-delete')
                        <button type="submit" class="dropdown-item sa-confirm">
                            <i class="ph-trash me-2"></i>{{ __('Delete') }}
                        </button>
                    @endcan
                </form>
            </div>
        </div>
    </div>
@endcanany
