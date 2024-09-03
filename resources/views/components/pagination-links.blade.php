<div>
    @if ($paginator->hasPages())
    <div class="d-flex align-items-center justify-content-center mt-4">
        <div class="d-flex align-items-center flex-shrink-0">
            <!-- Pagination-->
            <nav class="mx-auto" aria-label="Pagination Navigation">
              <ul class="pagination justify-content-center">
                @if ($paginator->onFirstPage())
                <li class="page-item">
                    <span class="page-link"><i class="fas fa-chevron-left me-2"></i></span>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:void(0)" wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="page-link">
                        <i class="fas fa-chevron-left me-2"></i>
                    </a>
                </li>
                {{-- <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev">Previous</button> --}}
                @endif
                
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item" wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}">
                                    <a href="javascript:void(0)" class="page-link" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->onLastPage())
                <li class="page-item">
                    <span class="page-link"><i class="fas fa-chevron-right ms-2"></i></span>
                </li>
                @else
                <li class="page-item">
                    <a href="javascript:void(0)" wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="page-link">
                        <i class="fas fa-chevron-right ms-2"></i>
                    </a>
                </li>
                @endif
              </ul>
            </nav>
        </div>
    </div>
        {{-- <nav role="navigation" aria-label="Pagination Navigation">
            <span>
                @if ($paginator->onFirstPage())
                    <span>Previous</span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev">Previous</button>
                @endif
            </span>

            <span>
                @if ($paginator->onLastPage())
                    <span>Next</span>
                @else
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next">Next</button>
                @endif
            </span>
        </nav> --}}
    @endif
</div>
