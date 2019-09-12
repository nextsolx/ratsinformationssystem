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
            subTitle: '',
            breadcrumbsList: [{ label: 'Köln', type: 'subdistrict' }]
        };
    },
    methods: {
        hide () {
            this.menuIsActive = false;
        },
        async getDistrictList () {
            this.navigationList = await location.getDistricts();
            this.subTitle = 'Stadtbezirke in Köln';
            this.loading = false;
        },
        async getSubdistrictList () {
            this.changeTitle(this.district + ' (Bezirk)');
            this.subTitle = 'Viertel in diesem Bezirk';
            this.location = 'subdistrict';
            this.navigationList = await location.getSubdistricts(this.district);
            this.loading = false;
        },
        async getIndexesList() {
            this.changeTitle(this.district + ' (Viertel)');
            this.subTitle = 'PLZ in diesem Viertel';
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
                    this.breadcrumbsList.push({
                        label: value,
                        type: 'index'
                    });
                    this.$emit('changeDirection', { type: 'district', value });
                    this.getSubdistrictList();
                    break;
                }
                case 'subdistrict': {
                    this.subDistrict = value;
                    this.breadcrumbsList.push({
                        label: value,
                        type: 'end_point'
                    });
                    this.getIndexesList();
                    break;
                }
                case 'index': {
                    this.changeTitle(value);
                    this.$emit('changeDirection', { type: 'index', value });
                    this.breadcrumbsList.push({
                        label: value,
                        type: null
                    });
                    this.location = 'end_point';
                    this.subTitle = '';
                    this.navigationList = [];
                    this.loading = false;
                    break;
                }
            }
        },
        buttonHandleOutSide (event, flag) {
            this.menuIsActive = false;
            this.loading = true;
            if (!flag) this.crumbsHandle();
            switch (this.location) {
                case 'end_point': {
                    this.$emit('changeDirection', { type: 'district', value: this.district });
                    this.getIndexesList();
                    break;
                }
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
            }
        },
        crumbsHandle (value) {
            this.loading = true;
            if (value) {
                this.breadcrumbsList = this.breadcrumbsList.slice(0, this.breadcrumbsList.indexOf(value) + 1);
                if (value.type) {
                    this.location = value.type;
                    this.buttonHandleOutSide('e', 'flag');
                }
            } else {
                this.breadcrumbsList = this.breadcrumbsList.slice(0, this.breadcrumbsList.length - 1);
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
        <MapAsideBreadcrumbs :option-list="breadcrumbsList" @clickCrumbs="crumbsHandle" />
        <h1 class="ris-map-desktop-aside__heading">{{ title }}</h1>
        <button
            v-if="district"
            class="ris-map-desktop-aside__nav-btn"
            @click="loading ? '' : buttonHandleOutSide()">
            <span class="ris-i ris-i_back ris-i_has-bg" />
            Zurück zur Bezirksübersicht
        </button>
        <h2 v-if="subTitle" class="ris-map-desktop-aside__sub-heading">{{ subTitle }}</h2>
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
                        @click="loading ? '' : buttonHandleInSide(element)">
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
