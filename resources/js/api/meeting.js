const axios = require('axios');

export default {
    getMeetingsByYearAndMonth(year, month) {
        return axios.get(`/api/meetings?year=${year}&month=${month}`).then(res => res.data);
    },
    getMeetingList(page) {
        return axios.get(`/api/meetings?page=${page}`).then(res => res.data);
    },
    getMeeting(meetingId) {
        return axios.get(`/api/meeting/${meetingId}`).then(res => res.data);
    },
};
