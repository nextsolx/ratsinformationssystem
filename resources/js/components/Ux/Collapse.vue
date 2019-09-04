<script>
import clickOutSide from '../../tools/clickOutSide';
import theme from '../../api/theme';
import { decodeHashParams } from '../../tools/helpers';
export default {
    name: 'Collapse',
    directives: {
        'outside': clickOutSide
    },
    data() {
        return {
            activeFilter: false,
            optionType: '',
            optionList: [],
            activeElement: null
        };
    },
    methods: {
        hide () {
            this.activeFilter = false;
        },
        linkUrlFilter (value) {
            if (this.search) {
                return `${this.pathname}${this.search}&${this.optionType}=${value}`;
            }
            else {
                return `${this.pathname}?${this.optionType}=${value}`;
            }
        },
        linkUrlUnfilter() {
            const filterList = this.search.split('&');
            if (filterList.length === 1) return `${this.pathname}`;
            else {
                filterList.length--;
                return `${this.pathname}${filterList.join('&')}`;
            }
        }
    },
    computed: {
        pathname () {
            return window.location.pathname;
        },
        search () {
            return window.location.search;
        }
    },
    async created() {
        let { district, subdistrict, index } = decodeHashParams(this.search.substr(1));
        if (index) {
            this.activeElement = index;
            return;
        }
        if (subdistrict) {
            this.activeElement = subdistrict;
            this.optionType = 'index';
            this.optionList = await theme.getIndexes(district, subdistrict);
            return;
        }
        if (district) {
            this.activeElement = district;
            this.optionType = 'subdistrict';
            this.optionList = await theme.getSubdistricts(district);
            return;
        }
        this.optionType = 'district';
        this.optionList =  await theme.getDistricts();
    },
};
</script>

<template>
    <div
        class="ris-filter"
        :class="{'ris-filter_active': activeFilter}"
        v-outside="hide">
        <button class="ris-filter__subheader ris-subheader" @click="activeFilter = !activeFilter">
            <span class="ris-i ris-i_filter"/>Filter
        </button>

        <div class="ris-filter__content">
            <div class="ris-filter-buttons ris-filter-buttons--selected" v-if="activeElement">
                <a
                    class="ris-label ris-label_has-border"
                    :href="linkUrlUnfilter()"
                        >
                    {{ activeElement }}
                    <span class="ris-i ris-i_close"/>
                </a>
            </div>

            <div class="ris-filter-buttons" v-if="optionList.length">
                <span class="ris-filter-buttons__title">
                    Nach Bezirken filtern
                </span>
                <a
                    class="ris-button ris-filter-buttons__item ris-button_secondary ris-button_has-shadow"
                    v-for="item in optionList"
                    :href="linkUrlFilter(item)"
                    :key="item">
                    {{ item }}
                </a>
            </div>
        </div>
    </div>
</template>
