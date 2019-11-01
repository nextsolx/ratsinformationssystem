<script>
import topics from '../../api/topics';
const moment = require('moment');

export default {
    name: 'ThemeSort',
    components: {
        UiDropdown: () => import('../Ui/UiDropdown'),
    },
    data: () => ({
        processSortedList: [],
        dropValue: {label: 'Chronologische Reihenfolge', value: 'id'},
    }),
    props: {
        themeId: {
            type: String,
            default: '',
        },
    },
    methods: {
        async loadProcessList() {
            if (this.themeId) {
                const theme = await topics.getTopicById(this.themeId);
                if (theme.data.process){
                    theme.data.process.map(process => {
                        if (process.meeting && process.agendum) {
                            this.processSortedList.push(process);
                        }
                    });
                }
            }
        },
        changeProcessList (selectedSortType) {
            this.dropValue = {label: selectedSortType.label, value: selectedSortType.value};
            this.processSortedList.reverse();

            const meetingProcessSelector = document.querySelector('.ris-process__agendum');
            if (meetingProcessSelector) {
                meetingProcessSelector.scrollIntoView({ behavior: 'smooth'});
            }
        },
    },
    filters: {
        momentDate(date) {
            return moment(date).format('DD. MMMM YYYY');
        },
    },
    created() {
        this.loadProcessList();
    },
};
</script>
