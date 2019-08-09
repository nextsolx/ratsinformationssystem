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
    }
};
</script>

<template>
    <nav>
        <ul class="ris-ul ris-committee-list-navigation__list">
            <li
                v-for="(element, index) in navigationList"
                class="ris-committee-list-navigation__item"
                :key="`${index}-list-button`">
                <button
                    @click="scrollToComponents(element.char)"
                    :id="`${element.char}-search-button`"
                    class="ris-committee-list-navigation__button">
                    {{ element.char }}
                </button>
            </li>
        </ul>
    </nav>
</template>
