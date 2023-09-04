@if ($paginator->hasPages())
    <div class="pagination">
        <ul class="pagination-list">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="pagination-dots">
                        ...
                    </li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <a href="{{ $url }}" class="btn btn-pagination active">
                                    {{ $page }}
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="btn btn-pagination">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    </div>
@endif
