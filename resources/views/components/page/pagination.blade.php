<!--Start Styled Pagination -->
<div class="row">
  <div class="col-12 text-center">
    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-center">

        {{-- Previous Page --}}
        @if ($paginator->onFirstPage())
          <li class="page-item disabled">
            <span class="page-link"><i class="fa fa-angle-left"></i> Previous</span>
          </li>
        @else
          <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1"><i class="fa fa-angle-left"></i> Previous</a>
          </li>
        @endif

        {{-- Pagination Elements --}}
        @php
          $current = $paginator->currentPage();
          $last    = $paginator->lastPage();
          $delta   = 2;
          $range   = [];

          $range[] = 1;
          for ($i = max(2, $current - $delta); $i <= min($last - 1, $current + $delta); $i++) {
            $range[] = $i;
          }
          if ($last > 1) $range[] = $last;

          $range = array_unique($range);
          sort($range);
        @endphp

        @foreach ($range as $idx => $page)
          @if ($idx > 0 && $page - $range[$idx - 1] > 1)
            <li class="page-item disabled"><span class="page-link">…</span></li>
          @endif

          @if ($page == $current)
            <li class="page-item active">
              <span class="page-link">{{ $page }}</span>
            </li>
          @else
            <li class="page-item">
              <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
            </li>
          @endif
        @endforeach

        {{-- Next Page --}}
        @if ($paginator->hasMorePages())
          <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next
              <i class="fa fa-angle-right"></i>
            </a>
          </li>
        @else
          <li class="page-item disabled">
            <span class="page-link">Next
              <i class="fa fa-angle-right"></i>
            </span>
          </li>
        @endif

      </ul>
    </nav>
  </div>
</div>
<!--Start Styled Pagination -->
