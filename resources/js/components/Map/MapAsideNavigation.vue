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
        callNavigation: {
            type: Object,
            default: () => {},
        },
    },
    data () {
        return {
            menuIsActive: this.isActive,
            navigationList: [],
            location: 'city',
            district: '',
            subDistrict: '',
            loading: true,
            title: 'Karte',
            subTitle: '',
            breadcrumbsList: [{ label: 'Köln', type: 'district' }]
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
            this.navigationList = await location.getSubdistricts(this.district);
            this.loading = false;
        },
        async getPostcodeList() {
            this.changeTitle(this.subDistrict + ' (Viertel)');
            this.subTitle = 'PLZ in diesem Viertel';
            this.navigationList = await location.getPostcodes(this.district, this.subDistrict);
            this.loading = false;
        },
        changeDirection (value) {
            this.$emit('changeDirection', { type: this.location, value });
        },
        buttonHandleInSide (value, bus = true) {
            this.menuIsActive = false;
            this.loading = true;

            switch (this.location) {
                case 'city': {
                    this.district = value;
                    this.breadcrumbsList.push({
                        label: value,
                        type: 'subdistrict'
                    });
                    this.location = 'district';
                    if (bus) Bus.$emit('select-district', value);

                    this.changeDirection(value);
                    this.getSubdistrictList();
                    break;
                }
                case 'district': {
                    this.subDistrict = value;
                    this.breadcrumbsList.push({
                        label: value,
                        type: 'postcode'
                    });
                    this.location = 'subdistrict';
                    if (bus) Bus.$emit('select-subdistrict', value);

                    this.changeDirection(value);
                    this.getPostcodeList();
                    break;
                }
                case 'subdistrict': {
                    this.changeTitle(value);
                    this.breadcrumbsList.push({
                        label: value,
                        type: null
                    });
                    this.location = 'postcode';
                    if (bus) Bus.$emit('select-postcode', value);

                    this.changeDirection(value);
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
                case 'postcode': {
                    this.location = 'subdistrict';
                    Bus.$emit('select-subdistrict', this.subDistrict);

                    this.changeDirection(this.subDistrict);
                    this.getPostcodeList();
                    break;
                }
                case 'subdistrict': {
                    this.location = 'district';
                    Bus.$emit('select-district', this.district);

                    this.changeTitle(this.district + ' (Viertel)');
                    this.changeDirection(this.district);
                    this.getSubdistrictList();
                    break;
                }
                case 'district': {
                    this.location = 'city';
                    Bus.$emit('select-city');

                    this.changeTitle('Karte');
                    this.getDistrictList();
                    this.district = '';
                    this.changeDirection();
                    break;
                }
            }
        },
        getChildLocation () {
            if (this.location === 'city') {
                return 'district';
            } else if (this.location === 'district') {
                return 'subdistrict';
            } else if (this.location === 'subdistrict') {
                return 'postcode';
            } else {
                return null;
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
        /*Bus.$on('mapOut', (e) => {
            if (e.value) {
                this.buttonHandleInSide(e.value, false);
            }
        });*/

        Bus.$on('district-selected', areaName => {
            this.buttonHandleInSide(areaName, false);
        });
        Bus.$on('subdistrict-selected', areaName => {
            this.buttonHandleInSide(areaName, false);
        });
        /*Bus.$on('postcode-selected', areaName => {
            this.buttonHandleInSide(areaName, false);
        });*/
    }
};
</script>

<template>
    <div>
        <MapAsideBreadcrumbs
            :option-list="breadcrumbsList"
            @clickCrumbs="crumbsHandle"
                />
        <h1 class="ris-map-desktop-aside__heading">{{ title }}</h1>
        <button
            v-if="district"
            class="ris-map-desktop-aside__nav-btn"
            :class="{'ris-map-desktop-aside__nav-btn_disable': loading}"
            @click="loading ? '' : buttonHandleOutSide()"
                >
            <span class="ris-i ris-i_back ris-i_has-bg" />
            Zurück zur Bezirksübersicht
        </button>
        <h2 v-if="subTitle" class="ris-map-desktop-aside__sub-heading">{{ subTitle }}</h2>
        <transition name="fade-long">
            <nav class="ris-map-desktop-aside__nav"
                v-if="!loading && navigationList.length"
                v-outside="hide"
                    >
                <ul class="ris-map-desktop-aside-list"
                    :class="{ isActive: menuIsActive }">
                    <li
                        class="ris-map-desktop-aside-list__item"
                        v-for="element in navigationList"
                        :key="`${element}-${location}`"
                        @click="loading ? '' : buttonHandleInSide(element, true)">
                        <button class="ris-map-desktop-aside-list__button"
                            @mouseover="$emit('mouse-handle', { type: getChildLocation(), name: element})"
                            @mouseleave="$emit('mouse-handle', { type: getChildLocation(), name: null})"
                            @click="$emit('click-handle', { type: getChildLocation(), name: element})"
                                >
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
