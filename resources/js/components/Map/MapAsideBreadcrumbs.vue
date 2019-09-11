<script>
export default {
    name: 'MapAsideBreadcrumbs',
    props: {
        optionList: {
            type: Array,
            default: () => []
        }
    }
};
</script>

<template>
    <ol class="ris-breadcrumbs">
        <li class="ris-breadcrumbs__item">
            <a href="/" title="Stadt Koeln"
                class="ris-breadcrumbs__home-link ris-link">
                <span class="ris-i ris-i_house"/>
                <span class="ris-link__text">Stadt Koeln</span>
                <span class="ris-i ris-i_chevron-right"/>
            </a>
        </li>
        <li class="ris-breadcrumbs__item"
            v-for="item in optionList"
            :key="item.label">
            <button
                :title="item.label"
                @click="$emit('clickCrumbs', item.value)"
                class="ris-link">
                <span>{{ item.label }}</span>
                <span class="ris-i ris-i_chevron-right"/>
            </button>
        </li>
    </ol>
</template>
