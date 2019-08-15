<script>
export default {
    name: 'Search',
    props: {
        value: {
            type: String,
            default: () => ''
        },
        hiddenMob: {
            type: Boolean,
            default: false
        },
        inputPlaceholder: {
            type: String,
            default: 'Suche nach Themen, Vorlagen, Sitzungen...'
        }
    },
};
// TODO: add classes hidden/full-width
</script>

<template>
    <div
        class="ris-search ris-sorting__search"
        :class="[{ hiddenMob : hiddenMob }]">
        <button class="ris-search__button">
            <span class="ris-i ris-i_search"/>
        </button>
        <input type="search" class="ris-search__input" :value="value"
            @input="$event => $emit('input', $event.target.value)"
            :placeholder="inputPlaceholder"
                >
    </div>
</template>
