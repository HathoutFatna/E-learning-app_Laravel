<head>
    <style>
        .inlineb{
            display:inline-block;

        }
        .btnn{
            cursor:pointer;
            background:white;
            border:2px solid black;
            padding:5px 20px 5px 20px;
            border-radius:5px;
        }
        .btnn:hover{
            transform:scale(1.25);
        }
    </style>
</head>

@if ($paginator->hasPages())

    <nav>
        <div class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true"><button class="inlineb btnn" disabled=disabled style="margin-left:40%;border-radius:5px;">Page Précedente</button></span>
                </span>
            @else
                <span>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><button class="inlineb btnn" style="margin-left:40%;border-radius:5px;">Page Précedente</button></a>
                </span>
            @endif

            {{-- Pagination Elements --}}
          <!--  @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="disabled" aria-disabled="true"><span>{{ $element }}</span></span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="active" aria-current="page"><span>{{ $page }}</span></span>
                        @else
                            <span><a href="{{ $url }}">{{ $page }}</a></span>
                        @endif
                    @endforeach
                @endif
            @endforeach-->

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <span>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><button class="inlineb btnn" style="margin-right:35%;float:right;">Page Suivante</button></a>
                </span>
            @else
                <span class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true"><button class="inlineb btnn" disabled="disabled" style="margin-right:35%;float:right;">Page Suivante</button></span>
                </span>
            @endif
        </div>
    </nav>
@endif
