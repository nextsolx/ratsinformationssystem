<script>
const moment = require('moment');
require('moment/locale/de');

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
            return moment(data).format('dd.mm.yyyy');
        }
    }
};
</script>

<template>
    <div>
        <a class="ris-card-list__item"
            v-for="{ id, name } in themeListData"
            :key="id"
            :href="'/thema/' + id"
            :title="name"
                >
            <div class="ris-card-list__themes-top">
                <img src="/img/thumbnail-map-tile.png" class="ris-card-list__themes-img"
                    :alt="name">
                <div class="ris-body-1">
                    {{ name }}
                </div>
            </div>
            <div class="ris-card-list__themes-bottom">
                <div class="ris-caption ris-card-list__themes-number">
                    Thema &nbsp;
                    <span>2477</span>
                    /
                    <span>2018</span>
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

                <div class="ris-caption ris-card-list__themes-date">{{ '27.10.2018' | momentFullDate() }}</div>
            </div>
        </a>
    </div>
</template>
