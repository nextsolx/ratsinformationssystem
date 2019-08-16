<script>
import Dropdown from '../Ux/Dropdown';
import Search from '../Ux/Search';
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
        Dropdown,
        CalendarCard,
        Search
    },
    data() {
        return {
            unfilteredList: this.meetings,
            filterValue: 'dateFrom',
            filtered: false,
            inputValue: '',
            dropValue: {
                value: 'all',
                label: 'Alle'
            }
        };
    },
    created() {
        this.sortBy(this.sortByDate(this.unfilteredList), this.filterValue);
    },
    computed: {
        yearsList() {
            const list = [{
                label: 'Alle',
                value: 'all'
            }];
            this.uniqArray(this.unfilteredList.map(el => moment(el.dateFrom).year())).forEach(item => {
                list.push({
                    value: `${item}`,
                    label: `${item}`
                });
            });
            return list;
        }
    },
    methods: {
        sortByDate (list) {
            return list.sort((a,b) => new Date(a.start) - new Date(b.start));
        },
        filterMeetingsByTitle(value) {
            this.dropValue = {
                value: 'all',
                label: 'Alle'
            };
            if (value) {
                this.filterValue = 'title';
                this.filterList(value);
                this.sortBy(this.filteredList, 'dateFrom');
            } else this.sortBy(this.unfilteredList,'dateFrom');
        },
        filterMeetingsByDate(obj) {
            let value = obj.value;
            if (value !== 'all') {
                this.filterValue = 'dateFrom';
                this.filterList(value);
                this.sortBy(this.filteredList, 'dateFrom');
            } else this.sortBy(this.unfilteredList,'dateFrom');
        },
        uniqArray(arr) {
            const onlyUnique = (value, index, self) => self.indexOf(value) === index;
            return arr.filter( onlyUnique );
        }
    },
};
</script>

<template>
    <div class="ris-committee-sessions">
        <div class="ris-filter-wrapper">
            <Search v-model="inputValue" :hidden-mob="true" @input="filterMeetingsByTitle" />
            <Dropdown
                label="Sortierung"
                id="drop-sitzunget"
                :options="yearsList"
                @change="filterMeetingsByDate"
                :full-width-mob="true"
                v-model="dropValue" />
        </div>
        <h2 class="ris-h2 ris-committee-sessions__heading">
            {{ `${dropValue.label} (${sortedList.length} Sitzungen)` }}
        </h2>
        <div class="ris-calendar">
            <CalendarCard class="ris-calendar__card-list" v-for="(meeting, index) in sortedList " :key="index" :meeting-sorted-day-list="meeting" />
        </div>
    </div>
</template>
