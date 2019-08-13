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
            selected: this.options[0]
        };
    }
};
</script>

<template>
    <div :class="['ris-select ']">
        <label class="ris-select__label" v-if="label" :for="id">
            {{ label }}
            <select :id="id" class="ris-select__select" v-model="selected">
                <option class="ris-select__option" v-for="option in options" :key="option" :value="option" >
                    {{ option }}
                </option>
            </select>
        </label>

        <span class="ris-i ris-i_chevron-double"/>
    </div>
</template>
