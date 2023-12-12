@canany(['bills-view', 'bills-edit', 'bills-publish','bills-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            @can('bills-view')
                <a href="{{ route('bills.show',$bill->id) }}" class="dropdown-item">
                    <i class="ph-eye me-2"></i>{{ __('Show') }}
                </a>
            @endcan
            @if($bill->status !='Posted')
                @can('bills-edit')
                    <a href="{{ route('bills.edit',$bill->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('bills-publish')
                    @if(count($bill->billItems)>0)
                    <form method="POST" action="{{ route('bills.publish', $bill->id) }}">
                        @csrf
                        {{ method_field('PATCH') }}
                        <button type="submit" class="dropdown-item sa-post">
                            <i class="ph-fast-forward-circle me-2"></i>{{ __('Post') }}
                        </button>
                    </form>
                    @endif
                @endcan
            @endif
            @can('bills-delete')
                <form action="{{ route('bills.destroy',$bill->id) }}" method="POST">
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