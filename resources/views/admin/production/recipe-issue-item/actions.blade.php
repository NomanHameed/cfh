@canany(['recipeIssueItems-view', 'recipeIssueItems-edit', 'recipeIssueItems-delete'])
    <div class="d-inline-flex">
        <div class="dropdown">
            <a href="#" class="text-body" data-bs-toggle="dropdown">
                <i class="ph-list"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <form action="{{ route('recipe-issue-items.destroy',$recipeIssueItem->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
{{--                    @can('recipeIssueItems-view')--}}
{{--                        <a href="{{ route('recipe-issue-items.show',$recipeIssueItem->id) }}" class="dropdown-item">--}}
{{--                            <i class="ph-eye me-2"></i>{{ __('Show') }}--}}
{{--                        </a>--}}
{{--                    @endcan--}}
                    @can('recipeIssueItems-edit')
                        <a href="#" class="dropdown-item sa-confirm" data-bs-toggle="modal" data-bs-target="#addRecipeItem{{$recipeIssueItem->id}}">
                            <i class="ph-pen me-2"></i>{{ __('Edit') }}
                        </a>
                    @endcan
                    @can('recipeIssueItems-delete')
                        <button type="submit" class="dropdown-item sa-confirm">
                            <i class="ph-trash me-2"></i>{{ __('Delete') }}
                        </button>
                    @endcan
                </form>
            </div>
        </div>
    </div>
@endcanany
