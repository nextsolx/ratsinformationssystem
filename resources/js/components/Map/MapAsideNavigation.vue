<script>
import clickOutSide from '../../tools/clickOutSide';
import location from '../../api/location';
import MapAsideBreadcrumbs from './MapAsideBreadcrumbs';
export default {
    name: 'MapAsideNavigation',
    directives: {
        'outside': clickOutSide
    },
    components: {
        MapAsideBreadcrumbs
    },
    props: {
        isActive: {
            type: Boolean,
            default: false
        },
    },
    data () {
        return {
            menuIsActive: this.isActive,
            navigationList: [],
            location: 'district',
            district: '',
            subDistrict: '',
            loading: true,
            title: 'Karte',
        };
    },
    methods: {
        hide () {
            this.menuIsActive = false;
        },
        async getDistrictList () {
            this.navigationList = await location.getDistricts();
            this.loading = false;
        },
        async getSubdistrictList () {
            this.changeTitle(this.district + ' (Bezirk)');
            this.subTitle = 'Themen in diesem Bezirk';
            this.navigationList = await location.getSubdistricts(this.district);
            this.location = 'subdistrict';
            this.loading = false;
        },
        async getIndexesList() {
            this.changeTitle(this.district + ' (Viertel)');
            this.subTitle = 'Themen in diesem Viertel';
            this.navigationList = await location.getIndexes(this.district, this.subDistrict);
            this.location = 'index';
            this.loading = false;
        },
        buttonHandleInSide (value) {
            this.menuIsActive = false;
            this.loading = true;
            switch (this.location) {
                case 'district': {
                    this.district = value;
                    this.$emit('changeDirection', { type: 'district', value });
                    this.getSubdistrictList();
                    break;
                }
                case 'subdistrict': {
                    this.subDistrict = value;
                    this.getIndexesList();
                    break;
                }
                case 'index': {
                    this.changeTitle(value);
                    this.$emit('changeDirection', { type: 'index', value });
                    this.location = 'end_point';
                    this.navigationList = [];
                    break;
                }
            }
        },
        buttonHandleOutSide (value) {
            this.menuIsActive = false;
            switch (value || this.location) {
                case 'index': {
                    this.changeTitle(this.district + ' (Viertel)');
                    this.getSubdistrictList();
                    break;
                }
                case 'subdistrict': {
                    this.changeTitle('Karte');
                    this.getDistrictList();
                    this.district = '';
                    this.$emit('changeDirection', { type: 'all', value: null });
                    this.location = 'district';
                    break;
                }
                case 'district': {
                    break;
                }
                default: {
                    this.$emit('changeDirection', { type: 'district', value: this.district });
                    this.getIndexesList();
                }
            }
        },
        changeTitle (title) {
            this.title = title;
        },
    },
    created () {
        this.getDistrictList();
    }
};
</script>

<template>
    <div>
        <MapAsideBreadcrumbs :option-list="[]" @click="buttonHandleOutSide" />
        <h1 class="ris-map-desktop-aside__heading">{{ title }}</h1>
        <button
            v-if="district"
            class="ris-map-desktop-aside__nav-btn"
            @click="buttonHandleOutSide">
            <span class="ris-i ris-i_back ris-i_has-bg" />
            Zurück zur Bezirksübersicht
        </button>
        <transition name="fade-long">
            <nav class="ris-map-desktop-aside__nav"
                v-if="!loading && navigationList.length"
                v-outside="hide">
                <ul class="ris-map-desktop-aside-list"
                    :class="{ isActive: menuIsActive }">
                    <li
                        class="ris-map-desktop-aside-list__item"
                        v-for="element in navigationList"
                        :key="`${element}-${location}`"
                        @click="buttonHandleInSide(element)">
                        <button class="ris-map-desktop-aside-list__button">
                            {{ element }}
                            <span class="ris-i ris-i_add"/>
                        </button>
                    </li>
                </ul>
                <button
                    class="ris-map-desktop-aside__control"
                    :class="{ isActive: menuIsActive }"
                    v-if="navigationList.length > 3"
                    @click="menuIsActive = !menuIsActive">
                    {{ menuIsActive ? 'Weniger anzeigen' : `Alle ${ navigationList.length } anzeigen` }}
                    <span class="ris-i ris-i_expand-more"/>
                </button>
            </nav>
        </transition>
    </div>
</template>
