<script>
const moment = require('moment');

export default {
    name: 'CommitteeTableItem',
    props: {
        committee: {
            type: Object,
            default: () => {},
        },
    },
    filters: {
        momentDate(date) {
            return moment(date).date();
        },
        momentWeek(date) {
            return moment(date).format('MMMM');
        },
    },
};
</script>

<template z>
    <li>
        <a :href="'/gremien/' + committee.id" class="ris-table-list__link">
            <h3 class="ris-h3 ris-table-list__subtitle">{{ committee.title }}</h3>
            <span class="ris-table-list-secondary-list__item-wrapper">
                <span class="ris-table-list-secondary-list__counter"><span class="ris-i ris-i_people" />{{ committee.memberCount }}</span>
                <time class="ris-table-list-secondary-list__time" v-if="committee.nextMeetingDate">
                    <span class="ris-i ris-i_calendar-arrow" />
                    {{ committee.nextMeetingDate | momentDate }}. {{ committee.nextMeetingDate | momentWeek }}
                </time>
            </span>
            <button class="ris-i ris-i_chevron-right ris-table-list__button" />
        </a>
    </li>
</template>
