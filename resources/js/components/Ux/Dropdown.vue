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
            default: ''
        },
        id: {
            type: String,
            required: true
        },
        options: {
            type: Array,
            default: () => []
        },
        value: {
            type: String,
            default: ''
        }
    }
};
</script>

<template>
    <div :class="['ris-select']">
        <label class="ris-select__label" :for="id" v-if="label">
            {{ label }}
        </label>
        <select :id="id" class="ris-select__select" :value="value" @change="$event => $emit('change', $event.target.value)">
            <option class="ris-select__option" v-for="option in options" :key="option">
                {{ option }}
            </option>
        </select>

        <span class="ris-i ris-i_chevron-double"/>
    </div>
</template>
