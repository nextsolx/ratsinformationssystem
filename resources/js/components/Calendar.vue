<script>
import { ContentLoader } from 'vue-content-loader';
import noticeMixin from '../mixins/NoticeMixin';
import intersectionObserverMixin from '../mixins/intersectionObserverMixin';

const axios = require('axios');
const moment = require('moment');

export default {
    name: 'Calendar',
    components: {
        ContentLoader
    },
    mixins: [ noticeMixin, intersectionObserverMixin ],
    data: () => ({
        observableRootBlock: null,
        observableBlock: '.ris-footer',
        prevRatio: 0,
        loading: false,
        emptyMeetingList: false,
        meetingList: [],
        cardListSelector: '#card-list',
        currentPage: 1,
        infoTitle: 'All meetings have been loaded',
    }),
    methods: {
        lazyHandle() {
            if (!this.loading && !this.emptyMeetingList) {
                this.loading = true;
                this.currentPage += 1;
                const cardList = document.querySelector(this.cardListSelector);

                axios
                    .get('/api/meetings?page=' + this.currentPage)
                    .then(res => {
                        this.meetingList = Object.assign({}, this.meetingList, this.sortedMeetingList(res.data.data));

                        if (res.data.data.length === 0) {
                            this.emptyMeetingList = true;
                        }
                    })
                    .finally(() => {
                        this.loading = false;
                        cardList.dataset.pageLoaded = this.currentPage;
                    });
            }

            if (this.emptyMeetingList) {
                this.info(this.infoTitle);
            }
        },
        sortedMeetingList(meetingList) {
            let meetingListSorted = {};

            meetingList.forEach(meet => {
                const weekYear = moment(meet.dateFrom).week() + '_' + moment(meet.dateFrom).year();

                if (!(weekYear in meetingListSorted)) {
                    meetingListSorted[weekYear] = {
                        dayList: (() =>
                            meetingList.filter(dayMeetList =>
                                moment(dayMeetList.dateFrom).date() === moment(meet.dateFrom).date() &&
                                moment(dayMeetList.dateFrom).week() === moment(meet.dateFrom).week() &&
                                moment(dayMeetList.dateFrom).year() === moment(meet.dateFrom).year()
                            )
                        )()
                    };
                }
            });

            return meetingListSorted;
        }
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
        momentHour(date) {
            return moment(date).format('HH:mm');
        },
        momentDayWithYear(date) {
            return moment(date).format('dddd, DD. MMMM YYYY');
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
                        {{ meetingListPerDay[0].dateFrom | momentDate }}
                        <br>
                        <span class="ris-calendar__card-day-of-week">
                            {{ meetingListPerDay[0].dateFrom | momentDayFormat }}
                        </span>
                    </div>

                    <div class="ris-calendar__card-day-right">
                        <a class="ris-link ris-calendar__card"
                            v-for="{ id, title, dateFrom, dateTill, agendaCount, peopleCount, fileCount } in meetingListPerDay"
                            :title="title"
                            :href="'/meeting/' + id"
                            :key="id"
                            :data-date-from="dateFrom"
                                >
                            <h2 class="ris-title">
                                {{ title }}
                            </h2>
                            <div class="ris-subheader">
                                {{ dateFrom | momentDayWithYear }}
                                {{ dateFrom | momentHour }}-{{ dateTill | momentHour }} Uhr
                            </div>
                            <div class="ris-session-count">
                                <div class="ris-session-count__agenda">
                                    {{ agendaCount }}
                                    <span class="ris-i ris-i_list"/>
                                </div>
                                <div class="ris-session-count__people">
                                    {{ peopleCount }}
                                    <span class="ris-i ris-i_people"/>
                                </div>
                                <div class="ris-session-count__file">
                                    {{ fileCount }}
                                    <span class="ris-i ris-i_download"/>
                                </div>
                            </div>
                        </a>
                    </div>
                </section>
            </div>
            <div class="ris-subheader ris-calendar__card-list-ris-subheader">
                Kalenderwoche {{ meetingList[meetingWeekYearKey].dayList[0].dateFrom | momentWeek }}
            </div>
        </div>

        <content-loader v-if="loading"
            :primary-color="'#dadce0'"
            :height="100"
                >
            <rect x="5" y="15" rx="4" ry="4" width="20" height="6" />
            <rect x="5" y="30" rx="4" ry="4" width="20" height="6" />

            <rect x="42" y="15" rx="3" ry="3" width="346" height="6" />
            <rect x="42" y="30" rx="3" ry="3" width="346" height="6" />

            <rect x="40" y="52" rx="3" ry="3" width="25" height="6" />
            <rect x="95" y="52" rx="3" ry="3" width="25" height="6" />
            <rect x="145" y="52" rx="3" ry="3" width="25" height="6" />

            <rect x="40" y="80" rx="3" ry="3" width="130" height="6" />
        </content-loader>
    </div>
</template>
