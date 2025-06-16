<div class="mt-4">
    <nav>
        <ul class="pagination">
            @if ($users->onFirstPage())
                <li class="page-item">
                    <a class="page-link" href="" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                    </a>
                </li>
            @endif

            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)       
                @if ($page == $users->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span><li>
                @else
                    <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                @endif
            @endforeach

            @if ($users->hasMorePages())
                <li class="page-item">
                    <a class="page-link" aria-label="Previous">
                        <span aria-hidden="true">»</span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">»</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</div>