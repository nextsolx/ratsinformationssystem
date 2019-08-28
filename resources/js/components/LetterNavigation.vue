<script>
export default {
    name: 'CommitteeNavigation',
    props: {
        navigationList: {
            type: Array,
            default: () => ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N',
                'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'Ä', 'Ö', 'Ü', 'ß']
        },
        pagination: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        buttonHandle(id) {
            if (this.pagination) {
                this.$emit('click', id);
            }
            else {
                const el = document.querySelector(`#${id}-list-element`);
                if (el) {
                    el.scrollIntoView({ behavior: 'smooth' });
                }
            }
        },
    },
};
</script>

<template>
    <nav class="ris-letter-nav">
        <ul class="ris-ul ris-letter-nav__list">
            <li
                v-for="element in navigationList"
                class="ris-letter-nav__item"
                :key="`${element}-list-button`">
                <button
                    @click="buttonHandle(element)"
                    :id="`${element.toLowerCase()}-search-button`"
                    class="ris-letter-nav__button">
                    {{ element }}
                </button>
            </li>
        </ul>
    </nav>
</template>
