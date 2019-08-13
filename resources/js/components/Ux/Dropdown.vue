<script>
export default {
    name: 'Dropdown',
    model: {
        prop: 'value',
        event: 'change'
    },
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
            selected: this.options[0]
        };
    }
};
</script>

<template>
    <div :class="['ris-select ']">
        <label class="ris-select__label" :for="id" v-if="label">
            {{ label }}
        </label>
        <select :id="id" class="ris-select__select" v-model="selected" @change="$emit('change', selected)">
            <option class="ris-select__option" v-for="option in options" :key="option" :value="option" >
                {{ option }}
            </option>
        </select>

        <span class="ris-i ris-i_chevron-double"/>
    </div>
</template>
