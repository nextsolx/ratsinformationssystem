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
    <li class="ris">
        <img :src="member.photo" alt="member-photo">
    </li>
</template>
