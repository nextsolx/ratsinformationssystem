<script>
const moment = require('moment');
import topics from '../../api/topics';
import MapAsideNavigation from './MapAsideNavigation';
import lazyLoadMixin from '../../mixins/lazyLoadMixin';
export default {
    name: 'MapDesktopAside',
    components: {
        MapAsideNavigation
    },
    mixins: [lazyLoadMixin],
    data () {
        return {
            title: 'Karte',
            subTitle: 'Aktualle Themen',
            newsList: [],
            totalThemes: 0,
            paginationPage: 1,
            typeOfTheme: 'new',
            totalThemesText: 'Themen in ganz Köln'
        };
    },
    methods: {
        async getThemes () {
            const themes = await topics.getPaginationList('new', this.paginationPage);
            this.newsList = [...this.newsList, ...themes.data];
            this.totalThemes = themes.meta.total;
        },
        async getDistrictThemes (value) {
            const themes = await topics.getTopicsByDistrictList(value, this.paginationPage);
            this.newsList = [...this.newsList, ...themes.data];
            this.totalThemes = themes.meta.total;
        },
        async getIndexThemes (value) {
            const themes = await topics.getTopicsByIndexList(value, this.paginationPage);
            this.newsList = [...this.newsList, ...themes.data];
            this.totalThemes = themes.meta.total;
        },
        changeDirection ({ type, value }) {
            this.newsList = [];
            if (type === 'district') {
                this.totalThemesText = `Thema in ${value} (Bezirk)`;
                this.getDistrictThemes(value);
            }
            else if (type === 'all') {
                this.totalThemesText = 'Themen in ganz Köln';
                this.getThemes();
            }
            else {
                this.totalThemesText = `Thema in ${value}`;
                this.getIndexThemes(value);
            }
        }
    },
    filters: {
        momentFullDate(data) {
            return moment(data).format('DD.MM.YYYY');
        }
    },
    created () {
        this.getThemes();
    },
};
</script>

<template>
    <aside class="ris-map-desktop-aside">
        <h1 class="ris-map-desktop-aside__heading">{{ title }}</h1>
        <MapAsideNavigation @changeTitle="(value) => this.title = value" @changeDirection="changeDirection" />
        <h2 class="ris-map-desktop-aside__subtitle">{{ subTitle }}</h2>
        <p class="ris-map-desktop-aside__caption">
            {{ `${totalThemes} ${totalThemesText}` }}
        </p>
        <ul class="ris-map-desktop-aside-theme-list">
            <li
                class="ris-map-desktop-aside-theme-list__item"
                v-for="theme in newsList"
                :key="theme.id">
                <a
                    class="ris-map-desktop-aside-theme-list__link"
                    :href="'/theme/' + theme.id">
                    <img
                        class="ris-map-desktop-aside-theme-list__img"
                        src="../../../img/theme-item-tile.jpg"
                        alt="theme pleceholder">
                    <div class="ris-map-desktop-aside-theme-list__wrapper">
                        <h3 class="ris-map-desktop-aside-theme-list__heading">{{ theme.name }}</h3>
                        <span class="ris-map-desktop-aside-theme-list__info">
                            <span class="ris-map-desktop-aside-theme-list__info">{{ theme.reference }}</span>
                            <time class="ris-map-desktop-aside-theme-list__time">
                                {{ theme.date | momentFullDate }}
                            </time>
                        </span>
                    </div>
                </a>
            </li>
        </ul>
    </aside>
</template>
