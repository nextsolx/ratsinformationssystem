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

    @if (url()->current() === route('theme-overview')
        or url()->current() === route('new-themes')
        or url()->current() === route('progress-themes')
        or url()->current() === route('finished-themes')
    )
        <li class="ris-breadcrumbs__item">
            <a href="{{ route('theme-overview') }}" title="Themen"
               class="ris-link"
            >
                <span>Themen</span>
                <span class="ris-i ris-i_chevron-right"></span>
            </a>
        </li>
    @endif

    @if (url()->current() === route('new-themes'))
        <li class="ris-breadcrumbs__item">
            <a href="{{ route('new-themes') }}" title="Neue Themen"
               class="ris-link"
            >
                <span>Neue Themen</span>
                <span class="ris-i ris-i_chevron-right"></span>
            </a>
        </li>
    @elseif (url()->current() === route('progress-themes'))
        <li class="ris-breadcrumbs__item">
            <a href="{{ route('progress-themes') }}" title="Kürzlich aktualisiert"
                class="ris-link"
            >
                <span>Kürzlich aktualisiert</span>
                <span class="ris-i ris-i_chevron-right"></span>
            </a>
        </li>
    @elseif (url()->current() === route('finished-themes'))
        <li class="ris-breadcrumbs__item">
            <a href="{{ route('finished-themes') }}" title="Kürzlich abgeschlossen"
                class="ris-link"
            >
                <span>Kürzlich abgeschlossen</span>
                <span class="ris-i ris-i_chevron-right"></span>
            </a>
        </li>
    @endif

</ol>
