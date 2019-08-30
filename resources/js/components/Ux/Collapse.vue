<script>
export default {
    name: 'Collapse',
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
    }
};
</script>

<template>
        <div class="ris-filter" :class="{'ris-filter_active': activeFilter}">
            <button class="ris-filter__subheader ris-subheader" @click="activeFilter = !activeFilter">
                <span class="ris-i ris-i_filter"/>Filtern
            </button>

            <div class="ris-filter__content">
                <!--<div class="ris-filter-buttons ris-filter-buttons__selected"
                    :class="{'ris-filter-buttons__selected_active' : selectedDistrictList.length }">
                    <button class="ris-label ris-label_has-border"
                        v-for="currentDistrictName in selectedDistrictList"
                        :key="currentDistrictName">
                        {{ currentDistrictName }}
                        <span class="ris-i ris-i_close"/>
                    </button>
                </div>-->

                <div class="ris-filter-buttons">
                    <span class="ris-filter-buttons__title">
                        Nach Bezirken filtern
                    </span>
                    <button
                        class="ris-button ris-button_secondary ris-button_has-shadow"
                        v-for="district in optionList.data"
                        :key="district">
                        {{ district }}
                    </button>
                </div>
            </div>
        </div>
</template>

