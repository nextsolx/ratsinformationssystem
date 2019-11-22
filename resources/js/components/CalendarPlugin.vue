<script>
import Vue from 'vue';
import VCalendar from 'v-calendar';

import meeting from '../api/meeting';
const moment = require('moment');

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
    name: 'CalendarPlugin',
    data: () => ({
        attrs: [],
        attrsToday: [
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
                    color: '#fff',
                },
                dates: [
                    new Date(),
                ],
            },
        ],
        navButtons: '.c-arrow-layout',
        meetingList: [],
        currentYear: moment().year(),
        currentMonth: moment().format('M'),
        loading: false,
        infoTitle: 'Calendar',
    }),
    methods: {
        toggleCalendar() {
            let weekdaysAndWeeks = document.querySelectorAll('.c-weekdays, .c-weeks');
            weekdaysAndWeeks.forEach(el => el.classList.toggle('hidden'));
        },
        toggleNavButtons() {
            const navButtons = document.querySelectorAll(this.navButtons);
            navButtons.forEach(el => {
                el.style.pointerEvents = this.loading ? 'none' : 'auto';
            });
        },
        async loadMeetings(year, month) {
            if (!this.loading) {
                this.loading = true;
                this.currentYear = year;
                this.currentMonth = month;

                this.toggleNavButtons();

                try {
                    const { data } = await meeting.getMeetingsByYearAndMonth(year, month);
                    if (data) {
                        this.attrs = [];
                        for (let { title, dateFrom } of data) {
                            this.attrs.push({
                                dates: [
                                    dateFrom
                                ],
                                popover: {
                                    label: title
                                },
                                dot: {
                                    backgroundColor:
                                        moment(dateFrom).isBefore(new Date())
                                            ? '#ccc'
                                            : moment().format('YYYY-MM-DD') === moment(dateFrom).format('YYYY-MM-DD') ? '#fff' : '#ed1c24',
                                },
                            });
                        }
                        this.attrs = [...this.attrs, ...this.attrsToday];
                    }
                } catch (e) {
                    console.error('getMeetingsByYearAndMonth: ', e);
                }

                this.loading = false;
                this.toggleNavButtons();
            }
        },
        navClicked(page) {
            this.loadMeetings(page.year, page.month);
        },
        dayClicked(day) {
            const date = document.querySelector(`#_${day.day}_${day.month}_${day.year}`);
            if (date) {
                date.scrollIntoView({ behavior: 'smooth' });
            }
        },
    },
    created() {
        this.loadMeetings(this.currentYear, this.currentMonth);
    }
};
</script>

<template>
    <div class="ris-calendar-app">
        <v-calendar
            :attributes="attrs"
            :is-expanded="true"
            @update:fromPage="navClicked"
            @dayclick="dayClicked"
                />
        <div class="ris-calendar-app__icon-calendar"
            @click="toggleCalendar"/>
    </div>
</template>
