<script>
import Vue from 'vue';

const moment = require('moment');
require('moment/locale/de');

Vue.use(require('vue-moment'), {
    moment
});

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

                <div class="ris-progress-bar"
                    v-if="themeListType === 'new'"
                        >
                    <div class="ris-progress-bar__progress" style="width: 25%"/>
                </div>
                <div class="ris-progress-bar"
                    v-else-if="themeListType === 'progress'"
                        >
                    <div class="ris-progress-bar__progress" style="width: 75%"/>
                </div>
                <div class="ris-card-list__themes-completed"
                    v-else-if="themeListType === 'finished'"
                        >
                    <span class="ris-i ris-i__check ris-i_has-bg"/>
                    Abgeschlossen
                </div>

                <div class="ris-caption ris-card-list__themes-date">27.10.2018</div>
            </div>
        </a>
    </div>
</template>
