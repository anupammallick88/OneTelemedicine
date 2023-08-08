@if ($paginator->hasPages())
<nav class="w-100">
    <ul class="pagination w-100">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <a href="javascript:void(0)" class="common-tbl-btn disabled-btn previous pagin"><i class="fas fa-arrow-left"></i>
            <span>{{ __('main.Previous') }}</span></a>
        @else
        <a href="{{ $paginator->previousPageUrl() }}" class="common-tbl-btn view-button previous pagin"><i class="fas fa-arrow-left"></i>
            <span>{{ __('main.Previous') }}</span></a>
        @endif
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="common-tbl-btn view-button next pagin"><span>{{ __('main.Next') }}</span> <i class="fas fa-arrow-right"></i></a>
        @else
        <a href="javascript:void(0)" class="common-tbl-btn disabled-btn next"><span>{{ __('main.Next') }}</span> <i class="fas fa-arrow-right"></i></a>
        @endif
    </ul>
</nav>
@endif
