<script>
import moment from 'moment';
export default {
    name: 'ThemeWidget',
    props: {
        topic: {
            type: Object,
            default: () => {}
        }
    },
    filters: {
        momentFullDate(data) {
            return moment(data).format('DD.MM.YYYY');
        }
    }
};
</script>

<template>
    <a
        class="ris-theme-item"
        :href="'/thema/' + topic.id"
        :title="topic.name">
        <img src="/img/thumbnail-bridge-big-tile.png" class="ris-theme-item__image" alt="theme image">
        <div class="ris-theme-item__content">
            <div class="ris-theme-item__wrapper">
                <img src="/img/thumbnail-bridge-big-tile.png" class="ris-theme-item__image-mobi" alt="theme image">
                <h3 class="ris-theme-item__title">{{ topic.name }}</h3>
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

