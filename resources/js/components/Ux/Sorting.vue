<script>
import Dropdown from './Dropdown';
export default {
    name: 'Sorting',
    components: {
        Dropdown
    },
    props: {
        inputValue: {
            type: String,
            default: () => ''
        },
        displaySelect: {
            type: Boolean,
            default: true
        },
        displayInput: {
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
            value: this.inputValue,
            dropval: ''
        };
    },
};
// TODO: add classes hidden/full-width
</script>

<template>
    <div class="ris-sorting">
        <div
            :class="['ris-search ris-sorting__search',
                     { hiddenMob: inputHiddenMob },
                     { fullWidth : selectHiddenMob }]"
            v-if="displayInput">
            <button class="ris-search__button">
                <span class="ris-i ris-i_search"/>
            </button>
            <input type="search" class="ris-search__input" v-model="value"
                @input="$emit('input', value)"
                :placeholder="inputPlaceholder"
                    >
        </div>
        <Dropdown :options="['123','456','789']" id="kek" v-model="dropval" />
        <div
            :class="['ris-select ris-sorting__select',
                     { hiddenMob: selectHiddenMob },
                     { fullWidth: inputHiddenMob }]"
            v-if="displaySelect">
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
