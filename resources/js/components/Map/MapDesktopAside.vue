<script>
import location from '../../api/location';
import clickOutSide from '../../tools/clickOutSide';
export default {
    name: 'MapDesktopAside',
    directives: {
        'outside': clickOutSide
    },
    data () {
        return {
            location: 'district',
            navigationList: [],
            menuIsActive: false,
            loading: true,
            district: '',
            subdistrict: '',
            title: 'Karte'
        };
    },
    methods: {
        async getDistrictList () {
            this.navigationList = await location.getDistricts();
            this.loading = false;
        },
        async getSubdistrictList () {
            this.navigationList = await location.getSubdistricts(this.district);
            this.location = 'subdistrict';
        },

        async buttonHandleInSide (value) {
            this.menuIsActive = false;
            switch (this.location) {
                case 'district': {
                    this.district = value;
                    this.title = this.district + ' (Bezirk)';
                    this.getSubdistrictList();
                    break;
                }
                case 'subdistrict': {
                    this.subdistrict = value;
                    this.title = this.district + ' (Viertel)';
                    this.navigationList = await location.getIndexes(this.district, value);
                    this.location = 'index';
                    break;
                }
                case 'index': {
                    this.title = value;
                    this.navigationList = [];
                    break;
                }
            }
        },
        async buttonHandleOutSide () {
            this.menuIsActive = false;
            switch (this.location) {
                case 'index': {
                    this.title = this.district + ' (Viertel)';
                    this.getSubdistrictList();
                    break;
                }
                case 'subdistrict': {
                    this.title = 'Karte';
                    this.getDistrictList();
                    this.district = '';
                    this.location = 'district';
                    break;
                }
                case 'district': {
                    break;
                }
            }
        },
        hide () {
            this.menuIsActive = false;
        }
    },
    created () {
        this.getDistrictList();
    }
};
</script>

<template>
    <aside class="ris-map-desktop-aside">
        <h1 class="ris-map-desktop-aside__heading">{{ title }}</h1>
        <button
            v-if="district"
            class="ris-map-desktop-aside__nav-btn"
            @click="buttonHandleOutSide">
            <span class="ris-i ris-i_back ris-i_has-bg"></span>
            Zurück zur Bezirksübersicht
        </button>
        <nav
            class="ris-map-desktop-aside__nav"
            v-if="!loading && navigationList.length"
            v-outside="hide">
            <ul
                class="ris-map-desktop-aside-list"
                :class="{ isActive: menuIsActive }">
                <li
                    class="ris-map-desktop-aside-list__item"
                    v-for="element in navigationList"
                    :key="`${element}-${location}`"
                    @click="buttonHandleInSide(element)"
                        >
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
                {{ menuIsActive ? 'Weniger anzeigen' : `Alle ${navigationList.length} anzeigen` }}
                <span class="ris-i ris-i_expand-more"></span>
            </button>
        </nav>
    </aside>
</template>
