@canany(['recipes-view', 'recipes-edit', 'recipes-delete'])
    <div class="d-inline-flex">
        <div class="dropdown">
            <a href="#" class="text-body" data-bs-toggle="dropdown">
                <i class="ph-list"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end">

                @can('recipes-view')

                    <a href="{{ route('recipes.show',$recipe->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @if($recipe->status == 'Pending')
                    @can('orders-view')
                            <form action="{{ route('recipes.post', $recipe->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="dropdown-item sa1-confirm">
                                    <i class="ph-arrow-circle-up-right me-2"></i>{{ __('Post') }}
                                </button>
                            </form>
                    @endcan
                @endif
                @can('recipes-edit')
                    <a href="{{ route('recipes.edit',$recipe->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('recipes-delete')
                    <form action="{{ route('recipes.destroy',$recipe->id) }}" method="POST">
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
