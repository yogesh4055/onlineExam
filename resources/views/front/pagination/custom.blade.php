@if ($paginator->hasPages())
    <ul class="pagination pagination-sm m-0 float-right">
       
        @if ($paginator->onFirstPage())
            <li class="disabled page-item"><span>← Previous</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a></li>
        @endif
        @foreach ($elements as $element)
           
            @if (is_string($element))
                <li class="disabled page-item"><span>{{ $element }}</span></li>
            @endif
           
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a class="page-link" href="javascript:void(0)">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach        
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></li>
        @else
            <li class="disabled page-item"><span>Next →</span></li>
        @endif
    </ul>
@endif 