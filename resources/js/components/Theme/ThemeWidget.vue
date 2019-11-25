<script>
import moment from 'moment';
export default {
    name: 'ThemeWidget',
    props: {
        topic: {
            type: Object,
            default: () => {}
        },
        filterValue: {
            type: String,
            default: ''
        }
    },
    methods: {
        selectionFilter (value) {
            const reg = new RegExp(this.filterValue, 'gi');
            return value.replace(reg, str => '<span class="ris-selection">' + str + '</span>');
        }
    },
    filters: {
        momentFullDate(data) {
            return moment(data).format('DD.MM.YYYY');
        },
    }
};
</script>

<template>
    <a
        class="ris-theme-item"
        :href="'/thema/' + topic.id"
        :title="topic.name">
        <div class="ris-theme-item__content">
            <div class="ris-theme-item__wrapper">
                <h3 class="ris-theme-item__title" v-html="selectionFilter(topic.name)" />
            </div>
            <div class="ris-theme-item__info">
                <span class="ris-theme-item__reference">{{ `Thema ${topic.reference}` }}</span>
                <div v-if="topic.type === 'finished'" class="ris-item-finished">
                    <span class="ris-i ris-i_check ris-i_has-bg"/>
                    Abgeschlossen
                </div>
                <div v-else class="ris-progress-bar">
                    <div
                        class="ris-progress-bar__progress"
                        :style="{'width:': topic.type === 'new' ? '25%' : '75%'}"/>
                </div>
                <time class="ris-theme-item__date">{{ topic.date | momentFullDate }}</time>
            </div>
        </div>
    </a>
</template>

