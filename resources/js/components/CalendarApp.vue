<script>
import Vue from 'vue';
import VCalendar from 'v-calendar';
import noticeMixin from '../mixins/NoticeMixin';

const axios = require('axios');
const moment = require('moment');
require('moment/locale/de');

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
    mixins: [ noticeMixin ],
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
                    color: '#fafafa',
                },
                dates: [
                    new Date(),
                ],
            },
        ],
        navButtons: '.c-arrow-layout',
        meetingList: [],
        currentYear: moment().year(),
        currentMonth: moment().month() + 1,
        loading: false,
        infoTitle: 'Calendar',
        infoDescription: 'There are no meetings in the calendar for the current month',
    }),
    methods: {
        toggleCalendar() {
            let weekdaysAndWeeks = document.querySelectorAll('.c-weekdays, .c-weeks');
            weekdaysAndWeeks.forEach(el => el.classList.toggle('hidden'));
        },
        disableEnableNavButtons() {
            const navButtons = document.querySelectorAll(this.navButtons);
            navButtons.forEach(el => {
                el.style.pointerEvents = this.loading ? 'none' : 'auto';
            });
        },
        loadMeetings(year = this.currentYear, month = this.currentMonth) {
            if (!this.loading) {
                this.loading = true;
                this.currentYear = year;
                this.currentMonth = month;

                this.disableEnableNavButtons();

                axios
                    .get(`/api/meetings?year=${this.currentYear}&month=${this.currentMonth}`)
                    .then(res => {
                        this.attrs = [];

                        if (res.data.data.length > 0) {
                            for (let { title, dateFrom } of res.data.data) {
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
                                                : moment(dateFrom).isSame(new Date()) ? '#fff' : '#ed1c24',
                                    },
                                });
                            }
                        } else {
                            this.info(this.infoTitle, this.infoDescription);
                        }

                        this.attrs = [...this.attrs, ...this.attrsToday];
                    })
                    .finally(() => {
                        this.loading = false;
                        this.disableEnableNavButtons();
                    });
            }
        },
        navClicked(page) {
            this.loadMeetings(page.year, page.month);
        },
        dayClicked(day) {
            const $el = document.querySelector(`#_${day.day}_${day.month}_${day.year}`);
            if ($el) {
                $el.scrollIntoView({ behavior: 'smooth' });
            }
        },
    },
    mounted() {
        this.loadMeetings();
    }
};
</script>

<template>
    <aside class="ris-calendar-app">
        <v-calendar
            :attributes="attrs"
            :is-expanded="true"
            @update:fromPage="navClicked"
            @dayclick="dayClicked"
                />
        <div class="ris-calendar-app__icon-calendar"
            @click="toggleCalendar"/>
    </aside>
</template>
