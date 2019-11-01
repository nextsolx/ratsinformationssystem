<script>
export default {
    name: 'Search',
    props: {
        value: {
            type: String,
            default: () => '',
        },
        hiddenMob: {
            type: Boolean,
            default: false,
        },
        fullWidthMob: {
            type: Boolean,
            default: false,
        },
        inputPlaceholder: {
            type: String,
            default: 'Suche nach Themen, Vorlagen, Sitzungen...',
        },
    },
};
</script>

<template>
    <div class="ris-search ris-sorting__search"
        :class="[{ hiddenMob : hiddenMob }, { fullWidthMob: fullWidthMob }]"
            >
        <button class="ris-search__button" aria-label="Suche nach Ausschuss">
            <span class="ris-i ris-i_search"/>
        </button>
        <input type="search" class="ris-search__input" aria-label="Komiteesuchfeld"
            :value="value"
            :placeholder="inputPlaceholder"
            @input="$event => $emit('input', $event.target.value)"
                >
    </div>
</template>
