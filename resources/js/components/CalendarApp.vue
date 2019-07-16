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
    data: () => ({
        attrs: [
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
                popover: {
                    label: 'You just hovered over today\'s date!',
                },
                dot: {
                    backgroundColor: '#fff',
                },
            },
            {
                dates: [
                    new Date(2019, 6, 26),
                ],
                popover: {
                    label: 'Other date',
                },
                dot: {
                    backgroundColor: '#ed1c24',
                }
            },
            {
                dates: [
                    new Date(2019, 6, 26),
                ],
                popover: {
                    label: 'Other event on the same day',
                },
                dot: {
                    backgroundColor: '#ed1c24',
                }
            },
            {
                dates: [
                    new Date(2019, 6, 30),
                ],
                popover: {
                    label: 'Other date',
                },
                dot: {
                    backgroundColor: '#ed1c24',
                }
            },
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
        ]
    }),
    methods: {
        toggleCalendar() {
            let weekdaysAndWeeks = document.querySelectorAll('.c-weekdays, .c-weeks');
            weekdaysAndWeeks.forEach(el => el.classList.toggle('hidden'));
        }
    },
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
