<footer-app inline-template>
    <footer class="ris-footer">
        <ul class="ris-footer__link-list">
            <li>
                <a href="{{ route('privacy-policy') }}" title="Datenschutz"
                   class="ris-footer__link"
                >Datenschutz</a>
            </li>
            <li>
                <a href="{{ route('company') }}" title="Impressum"
                   class="ris-footer__link"
                >Impressum</a>
            </li>
        </ul>
        <button class="ris-footer__back-to-top"
            aria-label="Back to the top"
            @click="backToTop"
            >
            <span class="ris-i ris-i_back"></span>
        </button>
        <div class="ris-footer__logo"></div>
    </footer>
</footer-app>
