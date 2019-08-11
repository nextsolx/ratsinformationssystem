<script>
export default {
    name: 'Sorting',
    props: {
        inputValue: {
            type: String,
            default: () => ''
        },
        isSelect: {
            type: Boolean,
            default: true
        },
        isInput: {
            type: Boolean,
            default: true
        },
        inputHiddenMob: {
            type: Boolean,
            default: false
        },
        selectHiddenMob: {
            type: Boolean,
            default: false
        },
        inputPlaceholder: {
            type: String,
            default: 'Suche nach Themen, Vorlagen, Sitzungen...'
        },
    },
    data() {
        return {
            value: this.inputValue
        };
    },
};
// TODO: add classes hidden/full-width
</script>

<template>
    <div class="ris-sorting__wrapper">
        <div :class="['ris-search ris-sorting__search', { hiddenMob: inputHiddenMob }]" v-if="isInput">
            <button class="ris-search__button">
                <span class="ris-i ris-i_search"/>
            </button>
            <input type="search" class="ris-search__input" v-model="value"
                @input="$emit('input', value)"
                :placeholder="inputPlaceholder"
                    >
        </div>
        <div :class="['ris-select ris-committee-list__select', { hiddenMob: selectHiddenMob }, { hidden: inputHiddenMob }]" v-if="isSelect">
            <label class="ris-select__label">Darstellung</label>

            <select class="ris-select__select">
                <option class="ris-select__option" data-sort-type="newest-first">
                    Das Neuste zuerst
                </option>
                <option class="ris-select__option" data-sort-type="oldest-first">
                    Chronologische Reihenfolge
                </option>
            </select>
            <span class="ris-i ris-i_chevron-double"/>
        </div>
    </div>
</template>
