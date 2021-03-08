@if ($paginator->hasPages())
    <nav>
        <ul class="pagination p-center {{ $paginator->getOptions()['pageName'] }}">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled page-item" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true" class="ti-arrow-left"></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="#" data-page="{{ $paginator->currentPage() - 1 }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <span class="ti-arrow-left"></span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled page-item" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item current_page_active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a href="#" data-page="{{ $page }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a href="#" data-page="{{ $paginator->currentPage() + 1 }}" rel="next" aria-label="@lang('pagination.next')">
                        <span class="ti-arrow-right"></span>
                    </a>
                </li>
            @else
                <li class="disabled page-item" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true" class="ti-arrow-right"></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
