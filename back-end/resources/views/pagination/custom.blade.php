<div class="pagination d-flex justify-content-center">
    <ul class="d-flex list-unstyled justify-content-around">
        {{-- Visualizza i link precedenti --}}
        @if ($paginator->onFirstPage())
            <li class="disabled mx-2 fw-bold text-dark" aria-disabled="true"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Visualizza gli elementi delle pagine --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" separator --}}
            @if (is_string($element))
                <li class="disabled mx-2 fw-bold text-dark" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Elemento della pagina --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active mx-2 fw-bold text-dark" aria-current="page"><span>{{ $page }}</span>
                        </li>
                    @else
                        <li class="mx-2 fw-bold text-dark"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Visualizza i link successivi --}}
        @if ($paginator->hasMorePages())
            <li class="mx-2 fw-bold text-dark"><a class="mx-2 fw-bold text-dark" href="{{ $paginator->nextPageUrl() }}"
                    rel="next">&raquo;</a></li>
        @else
            <li class="disabled mx-2 fw-bold text-dark" aria-disabled="true"><span>&raquo;</span></li>
        @endif
    </ul>
</div>
