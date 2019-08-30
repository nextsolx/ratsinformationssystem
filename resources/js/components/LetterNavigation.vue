<script>
export default {
    name: 'CommitteeNavigation',
    props: {
        navigationList: {
            type: Array,
            default: () => ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N',
                'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z']
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
                v-for="letter in navigationList"
                class="ris-letter-nav__item"
                :key="`${letter}-list-button`">
                <button
                    @click="buttonHandle(letter)"
                    :id="`${letter.toLowerCase()}-search-button`"
                    class="ris-letter-nav__button">
                    {{ letter }}
                </button>
            </li>
        </ul>
    </nav>
</template>
