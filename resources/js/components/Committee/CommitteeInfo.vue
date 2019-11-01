<script>
export default {
    name: 'CommitteeInfo',
    props: {
        information: {
            type: String,
            default: 'info',
        },
        links: {
            type: Array,
            default: () => [],
        }
    },
    data () {
        return {
            dropValue: {},
        };
    },
};
</script>

<template>
    <div class="ris-committee-info">
        <p class="ris-committee-info__text ris-body-2"
            v-if="information"
                >
            {{ information }}
        </p>
        <div class="ris-committee-info__confirm ris-without-padding-mob">
            <h2 class="ris-h2 ris-committee-info__heading">Bürgereingabe</h2>
            <div class="ris-committee-info__wrapper">
                <h3 class="ris-h3 ris-committee-info__subheading">
                    <span class="ris-i ris-i_notice-box ris-committee-info__notice"/>
                    „Sie haben ein Anliegen, über das ein politisches Gremium entscheiden soll?“
                </h3>
                <a class="ris-link ris-link_button ris-committee-info__button"
                    href="https://www.stadt-koeln.de/service/onlinedienste/anregungen-beschwerden/index.html"
                    target="_blank" rel="noopener"
                        >
                    Eingabe einreichen
                </a>
            </div>
        </div>
        <nav class="ris-committee-info__nav">
            <h2 class="ris-h2 ris-committee-info__heading">Weiterführende Links</h2>
            <ul class="ris-ul ris-committee-info-list">
                <li class="ris-committee-info-list__item"
                    v-for="link in links"
                    :key="link.linkText">
                    <a :href="link.url" class="ris-committee-info-list__link" target="_blank" rel="noopener">
                        {{ link.linkText }}<span class="ris-committee-info-list__button ris-i ris-i_resize-text" />
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>
