<script>
import clickOutSide from '../../tools/clickOutSide';
export default {
    name: 'Collapse',
    directives: {
        'outside': clickOutSide
    },
    props: {
        optionList: {
            type: Object,
            default: () => []
        }
    },
    data() {
        return {
            activeFilter: false
        };
    },
    computed: {
        pathname () {
            return window.location.pathname;
        },
        search () {
            return window.location.search;
        },
        activeElement () {
            const filterList = this.search.split('=');
            return filterList[filterList.length - 1];
        }
    },
    methods: {
        hide () {
            this.activeFilter = false;
        },
        linkUrlFilter (value) {
            if (this.search) {
                return `${this.pathname}${this.search}&${this.optionList.type}=${value.toLowerCase()}`;
            }
            else {
                return `${this.pathname}?${this.optionList.type}=${value.toLowerCase()}`;
            }
        },
        linkUrlUnfilter() {
            const filterList = this.search.split('&');
            if (filterList.length === 1) return `${this.pathname}`;
            else {
                filterList.length--;
                return `${this.pathname}${filterList.join('')}`;
            }
        }
    }
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

            <div class="ris-filter-buttons">
                <span class="ris-filter-buttons__title">
                    Nach Bezirken filtern
                </span>
                <a
                    class="ris-button ris-filter-buttons__item ris-button_secondary ris-button_has-shadow"
                    v-for="district in optionList.data"
                    :href="linkUrlFilter(district)"
                    :key="district">
                    {{ district }}
                </a>
            </div>
        </div>
    </div>
</template>

