<script>
import moment from 'moment';
export default {
    name: 'ThemeWidget',
    props: {
        options: {
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
        :href="'/thema/' + options.id"
        :key="options.id"
        :title="options.name">
        <img src="https://via.placeholder.com/96" class="ris-theme-item__image" alt="theme image">
        <div class="ris-theme-item__content">
            <div class="ris-theme-item__wrapper">
                <img src="https://via.placeholder.com/72" class="ris-theme-item__image-mobi" alt="theme image">
                <h3 class="ris-theme-item__title">{{ options.name }}</h3>
            </div>
            <div class="ris-theme-item__info">
                <span class="ris-theme-item__reference">{{ `Thema ${options.reference}` }}</span>
                <div v-if="options.type === 'finished'" class="ris-item-finished">
                    <span class="ris-i ris-i_check ris-i_has-bg"/>
                    Abgeschlossen
                </div>
                <div v-else class="ris-progress-bar">
                    <div
                        class="ris-progress-bar__progress"
                        :style="{'width:': options.type === 'new' ? '25%' : '75%'}"/>
                </div>
                <time class="ris-theme-item__date">{{ options.date | momentFullDate }}</time>
            </div>
        </div>
    </a>
</template>

