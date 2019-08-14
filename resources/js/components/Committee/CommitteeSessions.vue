<script>
import Sorting from '../Ux/Sorting';
import sortingMixin from '../../mixins/sortingMixin';

export default {
    name: 'CommitteeSessions',
    mixins: [sortingMixin],
    props: {
        meetings: {
            type: Array,
            default: () => []
        }
    },
    components: {
        Sorting
    },
    data() {
        return {
            meetingList: []
        };
    },
    created() {
        this.sortBy(this.meetings,'date');
    }
};
</script>

<template>
    <div class="ris-committee-sessions">
        <Sorting class="ris-committee-sessions__sorting ris-without-padding-mob" :input-hidden-mob="true" />
        <h2 class="ris-h2 ris-committee-sessions__heading">2018 (6 Sitzungen)</h2>
    </div>
</template>
