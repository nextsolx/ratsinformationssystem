<script>
const moment = require('moment');

export default {
    name: 'MeetingList',
    components: {
        CalendarPlugin: () => import('../CalendarPlugin'),
        MeetingListLazy: () => import('./MeetingListLazy')
    },
    data: () => ({
        currentYear: moment().year(),
        currentMonth: moment().format('M'),
        currentDay: moment().date(),
    }),
    methods: {
        goToToday() {
            const currentDate = document.querySelector(`#_${this.currentDay}_${this.currentMonth}_${this.currentYear}`);
            if (currentDate) {
                currentDate.scrollIntoView({ behavior: 'smooth' });
            }
        }
    },
    mounted() {
        this.$nextTick(() => {
            setTimeout(() => {
                this.goToToday();
            }, 1000);
        });
    }
};
</script>
