<script>
const moment = require('moment');
export default {
    name: 'CommitteeTableItem',
    props: {
        committee: {
            type: Object,
            default: () => {}
        }
    },
    filters: {
        momentDate(date) {
            return moment(date).date();
        },
        momentWeek(date) {
            return moment(date).format('MMMM');
        }
    },
};
</script>

<template>
    <li>
        <a :href="'/gremien/' + committee.id" class="ris-committee-list__link">
            <h3 class="ris-h3 ris-committee-list__subtitle">{{ committee.title }}</h3>
            <span class="ris-committee-list-secondary-list__item-wrapper">
                <span class="ris-committee-list-secondary-list__counter">{{ committee.memberCount }}</span>
                <time class="ris-committee-list-secondary-list__time" v-if="committee.nextMeetingDate">{{ committee.nextMeetingDate | momentDate }}. {{ committee.nextMeetingDate | momentWeek }}</time>
            </span>
        </a>
    </li>
</template>
