@canany(['orders-view', 'orders-edit', 'orders-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('orders.destroy',$order->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('orders-view')
                    <a href="{{ route('orders.show',$order->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('orders-view')
                    <a href="{{ route('order.issue.items.index',$order->id) }}" class="dropdown-item">
                        <i class="ph-arrow-circle-up-right me-2"></i>{{ __('Issue') }}
                    </a>
                @endcan
                @can('orders-view')
                    <a href="{{ route('order.receive.items.index',$order->id) }}" class="dropdown-item">
                        <i class="ph-arrow-circle-up-left me-2"></i>{{ __('Plan') }}
                    </a>
                @endcan
                @can('orders-edit')
                    <a href="{{ route('orders.edit',$order->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('orders-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany