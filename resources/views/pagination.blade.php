@if ($paginator->lastPage() > 1)
<ul class="pagination">
    <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
        <a href="{{ $paginator->url(1) }}"><</a>
    </li>
    @foreach ($paginator as $page => $url)
        @if ($paginator->currentPage() > 2 && $page === 2)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif
        @if ($paginator->currentPage() < $paginator->count() - 2 && $page === $paginator->count() - 1)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif
        @if ($page == $paginator->currentPage())
            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
        @elseif (($page === $paginator->currentPage() + 1 || 
                         $page === $paginator->currentPage() + 2 || 
                         $page === $paginator->currentPage() - 1 || 
                         $page === $paginator->currentPage() - 2 || 
                         $page === $paginator->lastPage() || 
                         $page === 1) && $page != 0)
            <li class="page-item"><a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
        @endif

        
    @endforeach
    <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
        <a href="{{ $paginator->url($paginator->currentPage()+1) }}" >></a>
    </li>
</ul>
@endif