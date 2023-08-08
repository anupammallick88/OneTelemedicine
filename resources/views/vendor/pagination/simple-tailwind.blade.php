@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between w-100">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <span class="">
        {{ view_html(__('pagination.previous')) }}
    </span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="">
        {{ view_html(__('pagination.previous')) }}
    </a>
    @endif
    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="">
        {{ view_html(__('pagination.next')) }}
    </a>
    @else
    <span class="">
        {{ view_html(__('pagination.next')) }}
    </span>
    @endif
</nav>
@endif