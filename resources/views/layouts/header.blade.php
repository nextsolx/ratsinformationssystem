<header-app inline-template
    @nav-active="navActiveMethod"
>
    <header class="ris-header">
        <div class="ris-header__top">
            <a class="ris-logo" href="/" title="Stadt Koeln">
                <img class="ris-logo__desktop" src="./img/logo_desktop_stadt_koeln.png" alt="Stadt Koeln"/>
                <img class="ris-logo__mobile" src="./img/logo_mobile_stadt_koeln.png" alt="Stadt Koeln" content="noindex"/>
            </a>
            <div class="ris-slogan">Stadtpolitik</div>
            <a class="ris-account" href="/account"></a>
        </div>

        <div class="ris-header__bottom">
            <div class="ris-search" role="search">
                <button class="ris-search__button"></button>
                <input type="search" class="ris-search__input"
                       placeholder="Suche nach Themen, Vorlagen, Sitzungen..."
                />
            </div>

            <div class="ris-nav">
                <button class="ris-nav__cta ris-nav__cta_parent"
                        @click="close"
                >Menu</button>
                <div class="ris-nav__overlay"
                        @click.self.stop="close"
                        :class="{ 'ris-nav__overlay_active': navMobileActive }"
                >
                    <nav class="ris-nav__menu">
                        <div class="ris-nav__menu-header">
                            Menu

                            <button class="ris-nav__cta ris-nav__cta_child ris-i ris-i__close"
                                    @click="close"
                            >
                            </button>
                        </div>
                        <ul class="ris-nav__link-wrapper">
                            <li>
                                <a class="ris-nav__link @if (url()->current() === route('welcome')) ris-nav__link_active @endif"
                                   href="/"
                                >Start</a>
                            </li>
                            <li>
                                <a class="ris-nav__link
                                    @if (url()->current() === route('themes') or url()->current() === route('new-themes'))
                                        ris-nav__link_active
                                    @endif"
                                   href="{{ route('themes') }}"
                                >Themen</a>
                            </li>
                            <li>
                                <a class="ris-nav__link @if (url()->current() === route('map')) ris-nav__link_active @endif"
                                   href="{{ route('map') }}"
                                >Karte</a>
                            </li>
                            <li>
                                <a class="ris-nav__link @if (url()->current() === route('calendar')) ris-nav__link_active @endif"
                                   href="{{ route('calendar') }}"
                                >Kalender</a>
                            </li>
                            <li>
                                <a class="ris-nav__link @if (url()->current() === route('committee')) ris-nav__link_active @endif"
                                   href="{{ route('committee') }}"
                                >Gremien</a>
                            </li>

                            <li>
                                <a class="ris-nav__link @if (url()->current() === route('people')) ris-nav__link_active @endif"
                                   href="{{ route('people') }}"
                                >Personen</a>
                            </li>

                            <li>
                                <a class="ris-nav__link @if (url()->current() === route('bookmarks')) ris-nav__link_active @endif"
                                   href="{{ route('bookmarks') }}"
                                >Merkliste</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</header-app>
