<script>
const moment = require('moment');
import topics from '../../api/topics';
import MapAsideNavigation from './MapAsideNavigation';
import intersectionObserverMixin from '../../mixins/intersectionObserverMixin';
import { ContentLoader } from 'vue-content-loader';
export default {
    name: 'MapDesktopAside',
    components: {
        MapAsideNavigation,
        ContentLoader
    },
    mixins: [
        intersectionObserverMixin
    ],
    data () {
        return {
            subTitle: 'Aktualle Themen',
            newsList: [],
            totalThemes: 0,
            paginationPage: 1,
            loading: false,
            totalThemesText: 'Themen in ganz Köln',
            observableBlock: '.ris-load-element',
        };
    },
    methods: {
        async getThemes () {
            this.loading = true;
            const themes = await topics.getPaginationList('new', this.paginationPage);
            this.putData(themes);
        },
        async getDistrictThemes (value) {
            this.loading = true;
            const themes = await topics.getTopicsByDistrictList(value, this.paginationPage);
            this.putData(themes);
        },
        async getIndexThemes (value) {
            this.loading = true;
            const themes = await topics.getTopicsByIndexList(value, this.paginationPage);
            this.putData(themes);
        },
        putData (themes) {
            if (this.loading) {
                this.newsList = [...this.newsList, ...themes.data];
                this.totalThemes = themes.meta.total;
            }
            this.loading = false;
        },
        changeDirection ({ type, value }) {
            console.log('ACTION: ', type);
            this.$emit('selectedArea', { type, value });

            this.newsList = [];
            this.paginationPage = 1;
            if (type === 'district') {
                this.subTitle = 'Themen in diesem Bezirk';
                this.totalThemesText = `Thema in ${value} (Bezirk)`;
                this.getDistrictThemes(value);
            }
            else if (type === 'all') {
                this.subTitle = 'Aktuelle Themen';
                this.totalThemesText = 'Themen in ganz Köln';
                this.getThemes();
            }
            else if (type === 'index') {
                this.subTitle = 'Themen in dieser PLZ';
            }
            else {
                this.subTitle = 'Themen in diesem Viertel';
                this.totalThemesText = `Thema in ${value}`;
                this.getIndexThemes(value);
            }
        },
        lazyHandle () {
            if (!this.loading && this.newsList.length) {
                this.paginationPage++;
                this.getThemes();
            }
        },
    },
    filters: {
        momentFullDate(data) {
            return moment(data).format('DD.MM.YYYY');
        }
    },
    created() {
        this.getThemes();
    }
};
</script>

<template>
    <aside class="ris-map-desktop-aside">
        <MapAsideNavigation @changeDirection="changeDirection" />
        <h2 class="ris-map-desktop-aside__subtitle">{{ subTitle }}</h2>
        <p class="ris-map-desktop-aside__caption">
            {{ `${totalThemes} ${totalThemesText}` }}
        </p>
        <transition-group tag="ul" name="fade" class="ris-map-desktop-aside-theme-list">
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
        </transition-group>
        <span class="ris-load-element" />
        <content-loader v-if="loading" :primary-color="'#dadce0'" :height="140">
            <rect x="125" y="20" rx="4" ry="4" width="150" height="6" />
            <rect x="125" y="50" rx="3" ry="3" width="120" height="6" />
            <circle cx="60" cy="45" r="36" />
        </content-loader>
    </aside>
</template>
