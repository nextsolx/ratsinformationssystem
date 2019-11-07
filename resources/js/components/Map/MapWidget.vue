<script>
export default {
    name: 'MapWidget',
    props: {
        options: {
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
    }
};
</script>
<template>
    <div class="ris-map-widget">
        <div class="ris-map-widget__content">
            <h3 class="ris-h3 ris-map-widget__title" v-html="selectionFilter(options.streetAddress)" />
            <span class="ris-map-widget__sub-title" v-html="selectionFilter(`Stadt ${options.city}, PLZ: ${options.postalCode}`)" />
        </div>
        <img src="/img/thumbnail-map-tile.png" loading="lazy" class="ris-map-widget__image">
    </div>
</template>
