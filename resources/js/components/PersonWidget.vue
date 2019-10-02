<script>
export default {
    name: 'PersonWidget',
    props: {
        person: {
            type: Object,
            default: () => {}
        }
    }
};
</script>
<template>
    <a
        :href="'/personen/' + person.id"
        class="ris-person">
        <img src="https://via.placeholder.com/112" class="ris-person__image" alt="person">
        <div class="ris-person__content">
            <h3 class="ris-person__title">{{ person.name }}</h3>
            <span class="ris-person__info" v-if="person.party">{{ person.party }}</span>
            <span class="ris-person__info" v-else>{{ person.role }}</span>
            <span class="ris-i ris-i_chevron-right ris-person__icon"></span>
        </div>
    </a>
</template>

