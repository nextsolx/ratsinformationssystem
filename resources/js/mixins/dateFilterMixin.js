const moment = require('moment');
require('moment/locale/de');

export default {
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

