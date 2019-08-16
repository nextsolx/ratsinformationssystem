<ol class="ris-breadcrumbs">
    <li class="ris-breadcrumbs__item">
        <a href="{{ route('welcome') }}" title="Stadt Koeln"
           class="ris-breadcrumbs__home-link ris-link"
        >
            <span class="ris-i ris-i_house"></span>
            <span class="ris-link__text">Stadt Koeln</span>
            <span class="ris-i ris-i_chevron-right"></span>
        </a>
    </li>

    @if (is_array($breadcrumbs))
        <li class="ris-breadcrumbs__item">
            <a href="{{ array_values($breadcrumbs)[0] }}" title= {{array_keys($breadcrumbs)[0] }}
                    class="ris-link"
            >
                <span>{{ array_keys($breadcrumbs)[0] }}</span>
                <span class="ris-i ris-i_chevron-right"></span>
            </a>
        </li>
    @endif

    @if (count($breadcrumbs)>1)
        <li class="ris-breadcrumbs__item">
            <a href="{{ array_values($breadcrumbs)[1] }}" title= {{array_keys($breadcrumbs)[1] }}
                    class="ris-link"
            >
                <span>{{ array_keys($breadcrumbs)[1] }}</span>
                <span class="ris-i ris-i_chevron-right"></span>
            </a>
        </li>
    @endif
</ol>
