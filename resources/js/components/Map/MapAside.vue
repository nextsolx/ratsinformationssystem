<script>
import moment from 'moment';
import topics from '../../api/topics';
import MapAsideNavigation from './MapAsideNavigation';
import intersectionObserverMixin from '../../mixins/intersectionObserverMixin';
import { ContentLoader } from 'vue-content-loader';
export default {
    name: 'MapAside',
    components: {
        MapAsideNavigation,
        ContentLoader
    },
    mixins: [
        intersectionObserverMixin
    ],
    data () {
        return {
            subTitle: 'Aktuelle Themen',
            themeList: [],
            themeLocationList: [],
            totalThemes: 0,
            paginationPage: 1,
            loading: false,
            totalThemesText: 'Themen in ganz Köln',
            observableBlock: '.ris-load-element',
            district: '',
            postcode: '',
            location: 'city',
        };
    },
    props: {
        callNavigation: {
            type: Object,
            default: () => {},
        },
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
        async getPostcodeThemes (value) {
            this.loading = true;
            const themes = await topics.getTopicsByIndexList(value, this.paginationPage);
            this.putData(themes);
        },
        putData (themes) {
            if (this.loading) {
                this.themeList = [...this.themeList, ...themes.data];
                this.totalThemes = themes.meta.total;

                themes.data.forEach(theme => {
                    theme.location.forEach(themeLocation => {
                        if (themeLocation.geo) {
                            this.themeLocationList.push({
                                'geo': themeLocation.geo,
                                'postalCode': +themeLocation.postalCode
                            });
                        }
                    });
                });
                this.$emit('theme-location-list', this.themeLocationList);
            }
            this.loading = false;
        },
        changeDirection ({ type, value }) {
            this.themeList = [];
            this.themeLocationList = [];
            this.totalThemes = 0;
            this.paginationPage = 1;
            this.location = type;

            switch (type) {
                case 'city': {
                    this.subTitle = 'Aktuelle Themen';
                    this.totalThemesText = 'Themen in ganz Köln';
                    this.getThemes();
                    break;
                }
                case 'district': {
                    this.district = value;
                    this.subTitle = 'Themen in diesem Bezirk';
                    this.totalThemesText = `Thema in ${this.district} (Bezirk)`;
                    this.getDistrictThemes(this.district);
                    break;
                }
                case 'subdistrict': {
                    // for the subdistrict the data is the same like for the district and title will not be updated to subdistict
                    this.subTitle = 'Themen in diesem Bezirk';
                    this.totalThemesText = `Thema in ${this.district} (Bezirk)`;
                    this.getDistrictThemes(this.district);
                    break;
                }
                case 'postcode': {
                    this.postcode = value;
                    this.subTitle = 'Themen in dieser PLZ';
                    this.totalThemesText = `Thema in ${this.postcode}`;
                    this.getPostcodeThemes(this.postcode);
                    break;
                }
            }
        },
        lazyHandle () {
            if (!this.loading && this.themeList.length) {
                this.paginationPage++;

                switch (this.location) {
                    case 'city': {
                        this.getThemes();
                        break;
                    }
                    case 'district': {
                        this.getDistrictThemes(this.district);
                        break;
                    }
                    case 'subdistrict': {
                        // also get district themes in the subdistrict
                        this.getDistrictThemes(this.district);
                        break;
                    }
                    case 'postcode': {
                        this.getPostcodeThemes(this.postcode);
                        break;
                    }
                }
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
    <div class="ris-map-desktop-aside">
        <MapAsideNavigation
            @changeDirection="changeDirection"
            :call-navigation="callNavigation"
            @mouse-handle="$emit('mouse-handle', $event)"
            @click-handle="$emit('click-handle', $event)"
            @theme-all-district-postcode-list="$emit('theme-all-district-postcode-list', $event)"
                />
        <h2 class="ris-map-desktop-aside__subtitle">{{ subTitle }}</h2>
        <p class="ris-map-desktop-aside__caption">
            {{ `${totalThemes} ${totalThemesText}` }}
        </p>
        <transition-group tag="ul" name="fade" class="ris-map-desktop-aside-theme-list">
            <li
                class="ris-map-desktop-aside-theme-list__item"
                v-for="theme in themeList"
                :key="theme.id">
                <a
                    class="ris-map-desktop-aside-theme-list__link"
                    :href="'/thema/' + theme.id">
                    <img
                        class="ris-map-desktop-aside-theme-list__img"
                        src="/img/theme-item-tile.jpg"
                        alt="theme pleceholder">
                    <div class="ris-map-desktop-aside-theme-list__wrapper">
                        <h3 class="ris-map-desktop-aside-theme-list__heading">{{ theme.name }}</h3>
                        <span class="ris-map-desktop-aside-theme-list__info">
                            <span class="ris-map-desktop-aside-theme-list__refer">{{ theme.reference }}</span>
                            <time class="ris-map-desktop-aside-theme-list__time">
                                {{ theme.date | momentFullDate }}
                            </time>
                            <button class="ris-button ris-map-desktop-aside-theme-list__btn">
                                Thema ansehen
                            </button>
                        </span>
                    </div>
                </a>
            </li>
            <li class="ris-map-desktop-aside-theme-list__item ris-loading-handle" v-show="loading || themeList.length" key="item-control">
                <span class="ris-load-element" key="load-element" />
                <content-loader v-if="loading" key="load-element-svg" :primary-color="'#dadce0'" :height="140">
                    <rect x="125" y="20" rx="4" ry="4" width="150" height="6" />
                    <rect x="125" y="50" rx="3" ry="3" width="120" height="6" />
                    <circle cx="60" cy="45" r="36" />
                </content-loader>
            </li>
        </transition-group>
    </div>
</template>
