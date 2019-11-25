<ol class="ris-breadcrumbs">
    <li class="ris-breadcrumbs__item">
        <a href="{{ route('welcome') }}" title="Stadt Koeln" aria-label="Stadt Koeln"
           class="ris-breadcrumbs__home-link ris-link"
        >
            <span class="ris-i ris-i_house"></span>
            <span class="ris-link__text">Stadt Koeln</span>
            <span class="ris-i ris-i_chevron-right"></span>
        </a>
    </li>

    @if (isset($breadcrumbs))
        @if (is_array($breadcrumbs))
            @foreach ($breadcrumbs as $breadcrumbName => $breadcrumbLink)
                @if ($loop->index === 0)
                    <li class="ris-breadcrumbs__item">
                        <a href="{{ $breadcrumbLink }}" title="{{ $breadcrumbName }}"
                                class="ris-link"
                        >
                            <span>{{ $breadcrumbName }}</span>
                            <span class="ris-i ris-i_chevron-right"></span>
                        </a>
                    </li>
                @else
                    <li class="ris-breadcrumbs__item">
                        <span>{{ $breadcrumbName }}</span>
                        <span class="ris-i ris-i_chevron-right"></span>
                    </li>
                @endif
            @endforeach
        @endif
    @endif
</ol>
