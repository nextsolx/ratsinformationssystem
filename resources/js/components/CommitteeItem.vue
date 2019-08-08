<script>
const moment = require('moment');
export default {
    name: 'CommitteeItem',
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
    }
};
</script>

<template>
    <li>
        <a href="#" class="ris-committee__link">
            <h3 class="ris-h3 ris-committee__subtitle">{{ committee.title }}</h3>
            <span class="ris-committee-secondary-list__item-wrapper">
                <span class="ris-committee-secondary-list__counter">{{ committee.memberCount }}</span>
                <time class="ris-committee-secondary-list__time">{{ committee.nextMeetingDate | momentDate }}. {{ committee.nextMeetingDate | momentWeek }}</time>
            </span>
        </a>
    </li>
</template>
