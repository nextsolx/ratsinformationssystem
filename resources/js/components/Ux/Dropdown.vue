<script>
export default {
    name: 'Dropdown',
    model: {
        prop: 'value',
        event: 'change',
    },
    props: {
        label: {
            type: String,
            default: '',
        },
        id: {
            type: String,
            required: true,
        },
        options: {
            type: Array,
            default: () => [],
        },
        value: {
            type: Object,
            default: () => {},
        },
        fullWidthMob: {
            type: Boolean,
            default: false,
        },
        hiddenMob: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        setValue(e) {
            const value = this.options.find(el => el.label === e.target.value);
            this.$emit('change', value);
        },
    },
};
</script>

<template>
    <div class="ris-select" :class="[{ fullWidthMob: fullWidthMob }, { hiddenMob: hiddenMob }]">
        <label class="ris-select__label" :for="id" v-if="label">
            {{ label }}
        </label>
        <select :id="id" class="ris-select__select" :value="value.label" @change="setValue">
            <option class="ris-select__option" v-for="option in options" :key="option.value" :value="option.label" >
                {{ option.label }}
            </option>
        </select>

        <span class="ris-i ris-i_chevron-double"/>
    </div>
</template>
