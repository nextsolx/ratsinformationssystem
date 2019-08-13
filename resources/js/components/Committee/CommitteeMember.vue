<script>
export default {
    name: 'CommitteeMember',
    props: {
        member: {
            type: Object,
            required: true
        },
        isParty: {
            type: Boolean,
            required: true
        }
    }
};
</script>

<template>
    <li class="ris ris-member">
        <a href="#" class="ris-member-link">
            <img v-if="member.photo" :src="member.photo" alt="member-photo" class="ris-member-link__img">
            <!--            <img v-else src="../../img/thumbnail-avatar.svg">-->
            <span class="ris-member-link__content">
                <h3 class="ris-h3 ris-member-link__heading">{{ member.name }}</h3>
                <span class="ris-member-link__text" v-if="isParty">{{ member.role }}</span>
                <span class="ris-member-link__text" v-else>{{ member.party }}</span>
            </span>
            <button class="ris-member-link__button" />
        </a>
    </li>
</template>
