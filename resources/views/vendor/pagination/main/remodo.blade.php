<div class="pagination  border-top mt-40 mb-70">
    @php
        $disabledClass='';
        $prevUrl=$paginator->previousPageUrl();
        $nextUrl=null;
    @endphp


    @if ($paginator->onFirstPage())
        @php
            $disabledClass='btn--disabled';
            $prevUrl=null;
        @endphp
    @endif

    <a href="{{$prevUrl}}" class="btn {{$disabledClass}} btn--md radius-3 ttu">
                            <span class="btn-ico me-3 w-20">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.6668 7.40509L8.3335 10.7384L11.6668 14.0718" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
        <span>Prev</span>
    </a>


    <ul class="pagination-list">
        @foreach ($elements as $element)

            {{--            @if (is_string($element))--}}
            {{--                <li>--}}
            {{--                    <span class="btn btn--sm-rounded rounded btn-40 border-none">{{ $element }}</span>--}}
            {{--                </li>--}}
            {{--            @endif--}}
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li>
                            <a href="" class="btn btn--warning btn--sm-rounded rounded btn-40 border-none">{{ $page }}</a>
                        </li>
                    @elseif($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2 || $page === $paginator->lastPage() || $page === 1)
                        <li>
                            <a href="{{ $url }}" class="btn btn--sm-rounded rounded btn-40 border-none">{{ $page }}</a>
                        </li>
                    @endif

                    @if ($paginator->currentPage() < $paginator->lastPage() - 3 && $page === $paginator->lastPage() - 1)
                        <li>
                            <span class="btn btn--sm-rounded rounded btn-40 border-none">...</span>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach



    </ul>
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="btn btn--dark btn--md radius-3 ttu">
            <span>Next</span>
            <span class="btn-ico ms-3 w-20">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.33317 14.0717L11.6665 10.7384L8.33317 7.40505" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
        </a>
    @else
                <a href="" class="btn btn--dark btn--disabled btn--md radius-3 ttu">
                    <span>Next</span>
                    <span class="btn-ico ms-3 w-20">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.33317 14.0717L11.6665 10.7384L8.33317 7.40505" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                </a>
    @endif


</div>
