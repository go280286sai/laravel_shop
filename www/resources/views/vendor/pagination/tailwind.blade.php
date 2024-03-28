@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div>
            <table class="table table-striped">
                <tr>
                    <td>
                        <div class="text-center">
                            @if ($paginator->onFirstPage())
                                <span>{!! __('pagination.previous') !!}</span>
                            @else
                                <a href="{{ $paginator->previousPageUrl() }}">{!! __('pagination.previous') !!}</a>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="text-center">
                            @if ($paginator->hasMorePages())
                                <a href="{{ $paginator->nextPageUrl() }}">{!! __('pagination.next') !!}</a>
                            @else
                                <span>{!! __('pagination.next') !!}</span>
                            @endif
                        </div>

                    </td>
                </tr>
            </table>
            <div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700 leading-5">
                            {!! __('pagination.showing') !!}
                            @if ($paginator->firstItem())
                                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                                {!! __('pagination.to') !!}
                                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                            @else
                                {{ $paginator->count() }}
                            @endif
                            {!! __('pagination.of') !!}
                            <span class="font-medium">{{ $paginator->total() }}</span>
                            {!! __('pagination.results') !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endif
