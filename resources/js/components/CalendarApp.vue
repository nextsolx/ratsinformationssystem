<script>
import Vue from 'vue';
import VCalendar from 'v-calendar';
const moment = require('moment');
require('moment/locale/de');


Vue.use(require('vue-moment'), {
    moment
});

Vue.use(VCalendar, {
    firstDayOfWeek: 2,  // Monday
    locale: 'de',
    titlePosition: 'left',
    dot: {
        diameter: '4px',
        opacity: '.8'
    },
    themeStyles: {
        wrapper: {}
    }
});

export default {
    name: 'CalendarApp',
    props: {
        meetingList: {
            type: Array,
            default: () => []
        }
    },
    data: () => ({
        attrs: [
            {
                contentStyle: {
                    fontWeight: 'bold',
                },
                dates: [
                    {
                        start: new Date(moment().year(), moment().month(), 1),
                        end: moment([moment().year(), moment().month(), 1]).add(1, 'months').subtract(1, 'day'),
                    },
                ],
            },
            {
                key: 'today',
                highlight: {
                    backgroundColor: '#ed1c24',
                    height: '32px',
                },
                contentStyle: {
                    color: '#fafafa',
                },
                dates: [
                    new Date(),
                ],
            },
        ]
    }),
    methods: {
        toggleCalendar() {
            let weekdaysAndWeeks = document.querySelectorAll('.c-weekdays, .c-weeks');
            weekdaysAndWeeks.forEach(el => el.classList.toggle('hidden'));
        }
    },
    mounted() {
        for(let meet of this.meetingList) {
            this.attrs.push({
                dates: [
                    meet.dateFrom
                ],
                popover: {
                    label: meet.title
                },
                dot: {
                    backgroundColor:
                        moment(meet.dateFrom).isBefore(new Date())
                            ? '#ccc'
                            : moment(meet.dateFrom).isSame(new Date()) ? '#fff' : '#ed1c24',
                },
            });
        }
    }
};
</script>

<template>
    <div class="ris-calendar-app">
        <v-calendar
            :attributes="attrs"
            :is-expanded="true"
                />
        <div class="ris-calendar-app__icon-calendar"
            @click="toggleCalendar">
        </div>
    </div>
</template>
