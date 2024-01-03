@canany(['invoices-view', 'invoices-edit', 'invoices-delete'])
    <div class="d-inline-flex">
        {{-- <div class="dropdown">
            <a href="#" class="text-body" data-bs-toggle="dropdown">
                <i class="ph-list"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end"> --}}
                @can('invoices-edit')
                    <a class="btn-link text-info" target="_blank"
                       href="{{ route('invoice.print', $invoice->id) }}">
                        <i class="ph-printer me-2"></i>
                    </a>
                @endcan
                @if($invoice->status !='Posted')
                    @can('invoices-edit')
                        <a href="{{ route('invoices.edit',$invoice->id) }}" class="btn-link text-primary">
                            <i class="ph-note-pencil me-2"></i>
                        </a>
                    @endcan
                    @can('invoices-publish')

                        <form method="POST" action="{{ route('invoices.publish', $invoice->id) }}">
                            @csrf
                            {{ method_field('PATCH') }}
                            <button type="submit" class="btn btn-link text-dark sa-post p-0">
                                <i class="ph-fast-forward-circle me-2"></i>
                            </button>
                        </form>
                    @endcan
                @endif
                @can('invoices-delete')
                    <form action="{{ route('invoices.destroy',$invoice->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link text-danger sa-confirm p-0">
                            <i class="ph-trash me-2"></i>
                        </button>
                    </form>
                @endcan
            {{-- </div>
        </div> --}}
    </div>
@endcanany
