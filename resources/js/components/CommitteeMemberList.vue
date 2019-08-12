<script>
import Sorting from './Sorting';
import CommitteeMember from './CommitteeMember';

export default {
    name: 'CommitteeMemberList',
    components: {
        Sorting,
        CommitteeMember
    },
    props: {
        members: {
            type: Array,
            default: () => []
        }
    }
};
</script>

<template>
    <div class="ris-committee-members">
        <Sorting class="ris-committee-members__sorting ris-without-padding-mob" :input-hidden-mob="true" />
        <h2 class="ris-h2 ris-committee-members__heading">Stimmberechtigt</h2>
        <ul class="ris-ul">
            <li v-for="(member, index) in members" :key="index">
                <CommitteeMember :member="member" />
            </li>
        </ul>
    </div>
</template>
