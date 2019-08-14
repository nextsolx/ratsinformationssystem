<script>
import Sorting from '../Ux/Sorting';
import sortingMixin from '../../mixins/sortingMixin';
import CalendarCard from '../CalendarCard';
const moment = require('moment');
require('moment/locale/de');

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
        Sorting,
        CalendarCard
    },
    data() {
        return {
            unfilteredList: this.meetings,
            filterValue: 'date',
            filtered: false,
            dropValue: 'all'
        };
    },
    created() {
        this.sortBy(this.unfilteredList,'date');
    },
    computed: {
        yearsList() { // [... new Set[array] returns new array with uniq values]
            return ['all',... new Set(this.unfilteredList.map(el => {
                return moment(el.date).year();
            }))];
        }
    },
    methods: {
        filterMeetingsByTitle(value) {
            if (value) {
                this.dropValue = 'all';
                this.filterValue = 'title';
                this.filterList(value);
                this.sortBy(this.filteredList, 'date');
            } else this.sortBy(this.unfilteredList,'date');
        },
        filterMeetingsByDate(value) {
            this.dropValue = value;
            if (value !== 'all') {
                this.filterValue = 'date';
                this.filterList(value);
                this.sortBy(this.filteredList, 'date');
            } else this.sortBy(this.unfilteredList,'date');
        },
    },
};
</script>

<template>
    <div class="ris-committee-sessions">
        <Sorting
            class="ris-committee-sessions__sorting ris-without-padding-mob"
            :drop-options="yearsList"
            @input="filterMeetingsByTitle"
            @change="filterMeetingsByDate"
            :input-hidden-mob="true" />
        <h2 class="ris-h2 ris-committee-sessions__heading">
            {{ `${dropValue} (${sortedList.length} Sitzungen)` }}
        </h2>
        <div>
            <CalendarCard class="ris-calendar__card-list" v-for="(meeting, index) in sortedList " :key="index" :meeting-sorted-day-list="meeting" />
        </div>
    </div>
</template>
