<script>
export default {
    name: 'CommitteeInfo',
    props: {
        information: {
            type: String,
            default: 'info',
        },
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
        <p class="ris-committee-info__text ris-body-2">{{ information }}</p>
        <div class="ris-committee-info__confirm ris-without-padding-mob">
            <h2 class="ris-h2 ris-committee-info__heading">Bürgereingabe</h2>
            <div class="ris-committee-info__wrapper">
                <h3 class="ris-h3 ris-committee-info__subheading">
                    <span class="ris-i ris-i_notice-box ris-committee-info__notice"/>
                    „Sie haben ein Anliegen, über das ein politisches Gremium entscheiden soll?“
                </h3>
                <a class="ris-link ris-link_button ris-committee-info__button"
                    href="https://www.stadt-koeln.de/service/onlinedienste/anregungen-beschwerden/index.html"
                    target="_blank"
                        >
                    Eingabe einreichen
                </a>
            </div>
        </div>
        <nav class="ris-committee-info__nav">
            <h2 class="ris-h2 ris-committee-info__heading">Weiterführende Links</h2>
            <ul class="ris-ul ris-committee-info-list">
                <li class="ris-committee-info-list__item">
                    § 14 der Hauptsatzung der Stadt Köln <a href="#" class="ris-committee-info-list__link ris-i ris-i_resize-text" />
                </li>
                <li class="ris-committee-info-list__item">
                    Bürgereingabe
                    § 24 der Gemeindeordnung Nordrhein-Westfalen (GO NW) <a href="#" class="ris-committee-info-list__link ris-i ris-i_resize-text" />
                </li>
                <li class="ris-committee-info-list__item">
                    Einwohnerantrag
                    § 24 der Gemeindeordnung Nordrhein-Westfalen (GO NW)<a href="#" class="ris-committee-info-list__link ris-i ris-i_resize-text" />
                </li>
                <li class="ris-committee-info-list__item">
                    Bürgerbegehren und Bürgerbescheid
                    § 26 der Gemeindeordnung Nordrhein-Westfalen (GO NW)<a href="#" class="ris-committee-info-list__link ris-i ris-i_resize-text" />
                </li>
            </ul>
        </nav>
    </div>
</template>
