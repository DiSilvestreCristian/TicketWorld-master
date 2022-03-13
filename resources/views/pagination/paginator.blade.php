@if ($paginator->lastPage() != 1)
    <div id="pagination">
        <!-- Link alla pagina precedente -->
        @if (!$paginator->onFirstPage())
            <a class="arrow" href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
        @endif
        <a class="page_number" href="#"><b>{{ $paginator->currentPage()}}</b></a>
        <!-- Link alla pagina successiva -->
        @if ($paginator->hasMorePages())
            <a class="arrow" href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
        @endif

    </div>
@endif
