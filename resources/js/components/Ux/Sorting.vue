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
        dropOptions: {
            type: Array,
            default: () => []
        },
        dropLabel: {
            type: String,
            default: () => ''
        },
        dropId: {
            type: String,
            default: 'dropId'
        }
    },
    data() {
        return {
            value: this.inputValue,
            dropValue: ''
        };
    },
};
// TODO: add classes hidden/full-width
</script>

<template>
    <div class="ris-sorting">
        <div
            class="ris-search ris-sorting__search"
            :class="[{ hiddenMob: inputHiddenMob },
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
        <Dropdown class="ris-sorting__select" :class="[{ hiddenMob: selectHiddenMob }, { fullWidth: inputHiddenMob }]"
            :label="dropLabel"
            :options="dropOptions"
            @change="$emit('change', dropValue)"
            :id="dropId"
            v-model="dropValue" />
    </div>
</template>
