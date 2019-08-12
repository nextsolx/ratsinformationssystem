<script>
import Sorting from './Sorting';
import CommitteeMember from './CommitteeMember';
import sortingMixin from '../mixins/sortingMixin';

export default {
    name: 'CommitteeMemberList',
    mixins: [sortingMixin],
    components: {
        Sorting,
        CommitteeMember
    },
    props: {
        members: {
            type: Array,
            default: () => []
        }
    },
    created() {
        this.sortBy(this.memberList,'function');
    },
    data() {
        return {
            memberList: this.members
        };
    },
};
</script>

<template>
    <div class="ris-committee-members">
        <Sorting class="ris-committee-members__sorting ris-without-padding-mob" :input-hidden-mob="true" />
        <ul class="ris-ul ris-committee-members-main-list">
            <li v-for="(item, index) in filteredList" :key="index" class="ris-committee-members-main-list__item">
                <h2 class="ris-committee-members__heading ris-h2">{{ item.title }}</h2>
                <ul class="ris-ul ris-committee-members-secondary-list">
                    <CommitteeMember
                        v-for="member in item.data"
                        :key="member.name"
                        :member="member"
                        :is-party="true"
                        class="ris-committee-members-secondary-list__item"
                            />
                </ul>
            </li>
        </ul>
    </div>
</template>
