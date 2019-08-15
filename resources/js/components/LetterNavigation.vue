<script>
export default {
    name: 'CommitteeNavigation',
    props: {
        navigationList: {
            type: Array,
            default: () => []
        }
    },
    methods: {
        scrollToComponents(id) {
            const el = document.querySelector(`#${id}-list-element`);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth'});
            }
        },
    },
};
</script>

<template>
    <nav class="ris-letter-nav">
        <ul class="ris-ul ris-letter-nav__list">
            <li
                v-for="(element, index) in navigationList"
                class="ris-letter-nav__item"
                :key="`${index}-list-button`">
                <button
                    @click="scrollToComponents(element.char)"
                    :id="`${element.char}-search-button`"
                    class="ris-letter-nav__button">
                    {{ element.char }}
                </button>
            </li>
        </ul>
    </nav>
</template>
