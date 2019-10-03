<script>
export default {
    name: 'PersonWidget',
    props: {
        person: {
            type: Object,
            default: () => {}
        },
        filterValue: {
            type: String,
            default: ''
        }
    },
    methods: {
        selectionFilter (value) {
            const reg = new RegExp(this.filterValue, 'gi');
            return value.replace(reg, str => '<span class="ris-selection">' + str + '</span>');
        }
    }
};
</script>
<template>
    <a
        :href="'/personen/' + person.id"
        class="ris-person">
        <img :src="person.photo" class="ris-person__image" alt="person">
        <div class="ris-person__content">
            <h3 class="ris-person__title" v-html="selectionFilter(person.name)" />
            <span class="ris-person__info" v-if="person.party">{{ person.party }}</span>
            <span class="ris-person__info" v-else>{{ person.role }}</span>
            <span class="ris-i ris-i_chevron-right ris-person__icon" />
        </div>
    </a>
</template>

