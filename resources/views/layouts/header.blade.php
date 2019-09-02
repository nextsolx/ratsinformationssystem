<header-app inline-template
    @nav-active="navActiveMethod"
>
    <header class="ris-header">
        <div class="ris-header__top">
            <a class="ris-logo" href="/" title="Stadt Koeln">
                <img class="ris-logo__desktop" src="/img/logo_desktop_stadt_koeln.png" alt="Stadt Koeln"/>
                <img class="ris-logo__mobile" src="/img/logo_mobile_stadt_koeln.png" alt="Stadt Koeln" content="noindex"/>
            </a>
            <div class="ris-slogan">Stadtpolitik</div>
            {{-- @todo --- out of scope of this functionality --}}
            {{--<a class="ris-account" href="/account">
                <span class="ris-i ris-i_account-circle"></span>
                <span class="ris-i ris-i_arrow-drop-down"></span>
            </a>--}}
        </div>

        <div class="ris-header__bottom">
            <div class="ris-search" role="search">
                <button class="ris-search__button">
                    <span class="ris-i ris-i_search"></span>
                </button>
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

                            <button class="ris-nav__cta ris-nav__cta_child ris-i ris-i_close"
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
                                    @if (url()->current() === route('theme-overview')
                                        or url()->current() === route('new-themes')
                                        or url()->current() === route('progress-themes')
                                        or url()->current() === route('finished-themes')
                                    )
                                        ris-nav__link_active
                                    @endif"
                                   href="{{ route('theme-overview') }}"
                                >Themen</a>
                            </li>
                            <li>
                                <a class="ris-nav__link @if (url()->current() === route('map')) ris-nav__link_active @endif"
                                   href="{{ route('map') }}"
                                >Karte</a>
                            </li>
                            <li>
                                <a class="ris-nav__link @if (url()->current() === route('calendar-list')) ris-nav__link_active @endif"
                                   href="{{ route('calendar-list') }}"
                                >Kalender</a>
                            </li>
                            <li>
                                <a class="ris-nav__link @if (url()->current() === route('committee-list')) ris-nav__link_active @endif"
                                   href="{{ route('committee-list') }}"
                                >Gremien</a>
                            </li>

                            <li>
                                <a class="ris-nav__link @if (url()->current() === route('people-list')) ris-nav__link_active @endif"
                                    href="{{ route('people-list') }}"
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
