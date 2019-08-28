const axios = require('axios');

export default {
    getPaginationList (page = 1) {
        return axios.get(`/api/people-list/?page=${page}`).then(res => res.data.members);
    },
    getListByLetter (letter) {
        return axios.get(`/api/people-list/?letter=${letter}`).then(res => res.data.members);
    },
    search (value) {
        return axios.get(`/api/people-list/?search=${value}`).then(res => res.data.members);
    }
};
