<script>
export default {
    name: 'MapWidget',
    props: {
        options: {
            type: Object,
            default: () => {}
        }
    },
};
</script>
<template>
    <a href="#" class="ris-map-widget">
        <div class="ris-map-widget__content">
            <h3 class="ris-h3 ris-map-widget__title">headline</h3>
            <span class="ris-map-widget__sub-title">subline</span>
        </div>
        <img src="https://via.placeholder.com/80" class="ris-map-widget__image">
    </a>
</template>
