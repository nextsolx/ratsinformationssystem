<script>
export default {
    name: 'CommitteeMember',
    props: {
        member: {
            type: Object,
            required: true
        }
    }
};
</script>

<template>
    <li class="ris ris-member">
        <a :href="'/personen/' +member.id" class="ris-member-link">
            <img v-if="member.photo" :src="member.photo" alt="member-photo" class="ris-member-link__img">
            <img v-else src="/img/thumbnail-avatar.svg" class="ris-member-link__img" alt="placeholder">
            <span class="ris-member-link__content">
                <h3 class="ris-h3 ris-member-link__heading">{{ member.name }}</h3>
                <span class="ris-member-link__text" v-if="member.party">{{ member.party }}</span>
                <span class="ris-member-link__text" v-else>{{ member.role }}</span>
            </span>
            <button class="ris-i ris-i_chevron-right ris-member-link__button" />
        </a>
    </li>
</template>
