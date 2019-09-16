<script>
export default {
    name: 'MapAsideBreadcrumbs',
    props: {
        optionList: {
            type: Array,
            default: () => []
        }
    },
    computed: {
        isShowed () {
            return this.optionList.length > 1;
        }
    },
    methods: {
        checkList () {
            if (this.isShowed) {
                document.querySelector('.ris-header').classList.add('hidden');
                document.querySelector('.ris-map__desktop').classList.add('fullHeight');
            } else {
                document.querySelector('.ris-header').classList.remove('hidden');
                document.querySelector('.ris-map__desktop').classList.remove('fullHeight');
            }
        }
    },
    watch: {
        optionList () {
            if (window.innerWidth <= 1040) {
                this.checkList();
            }
        }
    }
};
</script>

<template>
    <ol
        class="ris-breadcrumbs ris-breadcrumbs-map"
        :class="{ hidden : this.optionList.length < 2 }">
        <li class="ris-breadcrumbs__item">
            <a href="/" title="Stadt Koeln"
                class="ris-breadcrumbs__home-link ris-link">
                <span class="ris-i ris-i_house"/>
                <span class="ris-link__text">Stadt Koeln</span>
                <span class="ris-i ris-i_chevron-right"/>
            </a>
        </li>
        <li class="ris-breadcrumbs__item ris-breadcrumbs-map__item"
            v-for="(item, index) in optionList"
            :key="`${item.label}-${index}`">
            <button
                :title="item.label"
                @click="index === (optionList.length - 1) ? '' : $emit('clickCrumbs', item)"
                class="ris-link ris-breadcrumbs__button">
                {{ ((optionList.length - index >= 3) && (optionList.length > 2)) ? '...' : item.label }}
            </button>
        </li>
    </ol>
</template>
