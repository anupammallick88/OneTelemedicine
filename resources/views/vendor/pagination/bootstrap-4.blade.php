@if ($paginator->hasPages())
<div class="pagination-area text-center mt-5">
    <ul>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="disabled"><span><i class="fas fa-angle-left"></i></span></li>
        @else
        <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fas fa-angle-left"></i></a></li>
        @endif
        @if($paginator->currentPage() > 3)
        <li class="hidden-xs"><a href="{{ $paginator->url(1) }}">{{ __('1') }}</a></li>
        @endif
        @if($paginator->currentPage() > 4)
        <li class="disabled hidden-xs"><span>...</span></li>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
        @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
        @if ($i == $paginator->currentPage())
        <li class="active"><span>{{ $i }}</span></li>
        @else
        <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
        @endif
        @endif
        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - 3)
        <li class="disabled hidden-xs"><span>...</span></li>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
        <li class="hidden-xs"><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
        @endif
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fas fa-angle-right"></i></a></li>
        @else
        <li class="disabled"><span><i class="fas fa-angle-right"></i></span></li>
        @endif
    </ul>
</div>
@endif
