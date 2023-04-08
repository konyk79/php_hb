@php
    $pc = \App\PagConf::first();
    $next=$pc->next;
    $previous=$pc->previous;
@endphp

@if ($paginator->hasPages())
    <ul class="pagination-site xs-flex-column">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="nopdl disabled"><span class="button btn-blue-border">{{$previous}}</span></li>
        @else
            <li class="nopdl"><a class="button btn-blue-border" href="{{ $paginator->previousPageUrl() }}" rel="prev">{{$previous}}</a></li>
        @endif

        {{-- Pagination Elements --}}
       <div class="pagination-number xs-margin-t">
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
       </div>
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="nopdl"><a class="button btn-blue-border" href="{{ $paginator->nextPageUrl() }}" rel="next">{{$next}}</a></li>
        @else
            <li class="nopdl disabled"><span class="button btn-blue-border">{{$next}}</span></li>
        @endif
    </ul>
@endif
