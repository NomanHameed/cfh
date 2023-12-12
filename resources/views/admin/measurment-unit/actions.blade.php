@canany(['measurmentUnits-view', 'measurmentUnits-edit', 'measurmentUnits-delete'])
    <div class="d-inline-flex">
        <div class="dropdown">
            <a href="#" class="text-body" data-bs-toggle="dropdown">
                <i class="ph-list"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <form action="{{ route('measurment-units.destroy',$measurmentUnit->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @can('measurmentUnits-view')
                        <a href="{{ route('measurment-units.show',$measurmentUnit->id) }}" class="dropdown-item">
                            <i class="ph-eye me-2"></i>{{ __('Show') }}
                        </a>
                    @endcan
                    @can('measurmentUnits-edit')
                        <a href="{{ route('measurment-units.edit',$measurmentUnit->id) }}" class="dropdown-item">
                            <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                        </a>
                    @endcan
                    @can('measurmentUnits-delete')
                        <button type="submit" class="dropdown-item sa-confirm">
                            <i class="ph-trash me-2"></i>{{ __('Delete') }}
                        </button>
                    @endcan
                </form>
            </div>
        </div>
    </div>
@endcanany
