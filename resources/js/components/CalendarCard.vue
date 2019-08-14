<script>
import dateFilterMixin from '../mixins/dateFilterMixin';

export default {
    name: 'CalendarCard',
    mixins: [dateFilterMixin],
    props: {
        meetingSortedDayList: {
            type: Array,
            default: () => []
        }
    },
};
</script>

<template>
    <section class="ris-calendar__card-day">
        <div class="ris-calendar__card-day-left">
            {{ meetingSortedDayList.title }}
        </div>

        <div class="ris-calendar__card-day-right">
            <div class="ris-calendar__card"
                v-for="meetup in meetingSortedDayList.data"
                :key="meetup.title"
                :data-date-from="dateFrom"
                    >
                <h2 class="ris-title">
                    {{ meetup.title }}
                </h2>
                <div class="ris-subheader">
                    Lorem data UAK/
                    <span>00{{ meetup.date }}</span>
                    /
                    <span>{{ meetup.date}}</span>
                </div>
                <div class="ris-session-count">
                    <div class="ris-session-count__agenda">{{ meetup.topCount }}</div>
                    <div class="ris-session-count__people">{{ meetup.attendeesCount }}</div>
                    <div class="ris-session-count__file" v-if="meetup.fileCount">{{ meetup.fileCount }}</div>
                </div>
            </div>
        </div>
    </section>
</template>
