<script>
import dateFilterMixin from '../mixins/dateFilterMixin';

export default {
    name: 'CalendarCard',
    mixins: [dateFilterMixin],
    props: {
        meetingSortedDayList: {
            type: Object,
            default: () => []
        }
    },
};
</script>

<template>
    <section class="ris-calendar__card-day">
        <div class="ris-calendar__card-day-left">
            {{ meetingSortedDayList.title | momentDate }}
            <br>
            <span class="ris-calendar__card-day-of-week">
                {{ meetingSortedDayList.title | momentDayFormat }}
            </span>
        </div>

        <div class="ris-calendar__card-day-right">
            <div class="ris-calendar__card"
                v-for="meetup in meetingSortedDayList.data"
                :key="meetup.title"

                    >
                <div>
                    <h3 class="ris-title">
                        {{ meetup.title }}
                    </h3>
                    <div v-if="!meetup.isCancelled">
                        <p class="ris-subheader" >BA/0028/2018</p>
                        <div class="ris-session-count">
                            <span class="ris-session-count__agenda"><span class="ris-i ris-i_list" />{{ meetup.topCount }}</span>
                            <span class="ris-session-count__people"><span class="ris-i ris-i_people" />{{ meetup.attendeesCount }}</span>
                            <span class="ris-session-count__file" v-if="meetup.fileCount">{{ meetup.fileCount }}</span>
                        </div>
                    </div>
                    <p v-else class="ris-calendar__placeholder">
                        Sitzung ist ausgefallen
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
