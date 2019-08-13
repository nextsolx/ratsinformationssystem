<script>
export default {
    name: 'Dropdown',
    props: {
        label: {
            type: String,
            default: () => ''
        },
        id: {
            type: String,
            required: true
        },
        options: {
            type: Array,
            default: () => []
        }
    },
    data () {
        return {
            selected: ''
        };
    }
};
</script>

<template>
    <div :class="['ris-select']">
        <label class="ris-select__label" v-if="label" :for="id">
            {{ label }}
            <select :id="id" class="ris-select__select" v-model="selected">
                <option class="ris-select__option">
                    test
                </option>
                <option class="ris-select__option">
                    test1
                </option>
            </select>
        </label>

        <span class="ris-i ris-i_chevron-double"/>
    </div>
</template>
