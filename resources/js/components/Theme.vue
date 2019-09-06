<script>
const moment = require('moment');

export default {
    name: 'Theme',
    props: {
        themeListData: {
            type: Array,
            default: () => ([])

        },
        themeListType: {
            type: String,
            default: ''
        },
    },
    filters: {
        momentFullDate(data) {
            return moment(data).format('DD.MM.YYYY');
        }
    }
};
</script>

<template>
    <div>
        <a class="ris-card-list__item"
            v-for="item in themeListData"
            :key="item.id"
            :href="'/thema/' + item.id"
            :title="item.name"
                >
            <div class="ris-card-list__themes-top">
                <img src="/img/thumbnail-map-tile.png" class="ris-card-list__themes-img"
                    :alt="item.name">
                <h2 class="ris-h2">
                    {{ item.name }}
                </h2>
            </div>
            <div class="ris-card-list__themes-bottom">
                <div class="ris-caption ris-card-list__themes-number">
                    Thema {{ item.reference }}
                </div>

                <div class="ris-card-list__themes-completed"
                    v-if="themeListType === 'finished'"
                        >
                    <span class="ris-i ris-i_check ris-i_has-bg"/>
                    Abgeschlossen
                </div>
                <div class="ris-progress-bar"
                    v-else
                        >
                    <div class="ris-progress-bar__progress"
                        :style="{'width:': themeListType === 'new' ? '25%' : '75%'}"
                            />
                </div>

                <div class="ris-caption ris-card-list__themes-date">{{ item.date | momentFullDate }}</div>
            </div>
        </a>
    </div>
</template>
