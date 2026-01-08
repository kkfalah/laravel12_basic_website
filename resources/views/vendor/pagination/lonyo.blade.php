@if ($paginator->hasPages())
<div class="lonyo-pagination center">

    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <span class="pagi-btn btn2 disabled">
            <svg width="7" height="12" viewBox="0 0 7 12" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M0.75 0.75L6 6L0.75 11.25"
                      stroke="#001A3D" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
    @else
        <a class="pagi-btn btn2" href="{{ $paginator->previousPageUrl() }}">
            <svg width="7" height="12" viewBox="0 0 7 12" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M0.75 0.75L6 6L0.75 11.25"
                      stroke="#001A3D" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    @endif

    {{-- Pagination Numbers --}}
    <ul>
        @php
            $current = $paginator->currentPage();
            $last    = $paginator->lastPage();

            $start = max(2, $current - 1);
            $end   = min($last - 1, $current + 1);
        @endphp

        {{-- Page 1 --}}
        <li>
            <a href="{{ $paginator->url(1) }}" class="{{ $current == 1 ? 'current' : '' }}">
                1
            </a>
        </li>

        {{-- Left dots --}}
        @if ($start > 2)
            <li><span>...</span></li>
        @endif

        {{-- Middle pages --}}
        @for ($i = $start; $i <= $end; $i++)
            <li>
                <a href="{{ $paginator->url($i) }}" class="{{ $current == $i ? 'current' : '' }}">
                    {{ $i }}
                </a>
            </li>
        @endfor

        {{-- Right dots --}}
        @if ($end < $last - 1)
            <li><span>...</span></li>
        @endif

        {{-- Last page --}}
        @if ($last > 1)
            <li>
                <a href="{{ $paginator->url($last) }}" class="{{ $current == $last ? 'current' : '' }}">
                    {{ $last }}
                </a>
            </li>
        @endif
    </ul>

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a class="pagi-btn" href="{{ $paginator->nextPageUrl() }}">
            <svg width="7" height="12" viewBox="0 0 7 12" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M0.75 0.75L6 6L0.75 11.25"
                      stroke="#001A3D" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    @else
        <span class="pagi-btn disabled">
            <svg width="7" height="12" viewBox="0 0 7 12" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M0.75 0.75L6 6L0.75 11.25"
                      stroke="#001A3D" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
    @endif

</div>
@endif

