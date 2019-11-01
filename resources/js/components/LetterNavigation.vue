<script>
export default {
    name: 'LetterNavigation',
    props: {
        navigationList: {
            type: Array,
            default: () => ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n',
                'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z']
        },
        pagination: {
            type: Boolean,
            default: false
        },
        isShowed: {
            type: Boolean,
            default: true
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
        <ul class="ris-ul ris-letter-nav__list" v-if="isShowed">
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
