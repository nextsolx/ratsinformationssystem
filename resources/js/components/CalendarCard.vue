<script>
const moment = require('moment');

export default {
    name: 'CalendarCard',
    props: {

    },
    filters: {
        momentDate(date) {
            return moment(date).date();
        },
        momentDayFormat(date) {
            return moment(date).format('dd');
        },
        momentWeek(date) {
            return moment(date).week();
        },
        momentYear(date) {
            return moment(date).year();
        },
    },
};
</script>

<template>
    <div>
        <div v-for="(meetingWeekList, meetingWeekYearKey ) in meetingList"
            :key="meetingWeekYearKey">
            <div class="ris-calendar__card-list"
                v-for="(meetingListPerDay, meetingListPerDayKey) in meetingWeekList"
                :key="meetingListPerDayKey"
                    >
                <section class="ris-calendar__card-day">
                    <div class="ris-calendar__card-day-left">
                        {{ meetingListPerDay[0].dateFrom | momentDate() }}
                        <br>
                        <span class="ris-calendar__card-day-of-week">
                            {{ meetingListPerDay[0].dateFrom | momentDayFormat() }}
                        </span>
                    </div>

                    <div class="ris-calendar__card-day-right">
                        <div class="ris-calendar__card"
                            v-for="{ id, title, dateFrom, agendaCount, peopleCount, fileCount } in meetingListPerDay"
                            :key="id"
                            :data-date-from="dateFrom"
                                >
                            <h2 class="ris-title">
                                {{ title }}
                            </h2>
                            <div class="ris-subheader">
                                Lorem data UAK/
                                <span>00{{ dateFrom | momentWeek() }}</span>
                                /
                                <span>{{ dateFrom | momentYear() }}</span>
                            </div>
                            <div class="ris-session-count">
                                <div class="ris-session-count__agenda">{{ agendaCount }}</div>
                                <div class="ris-session-count__people">{{ peopleCount }}</div>
                                <div class="ris-session-count__file">{{ fileCount }}</div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="ris-subheader ris-calendar__card-list-ris-subheader">
                Kalenderwoche {{ meetingList[meetingWeekYearKey].dayList[0].dateFrom | momentWeek() }}
            </div>
        </div>
    </div>
</template>
