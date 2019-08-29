const axios = require('axios');

export default {
    getPaginationList (page = 1, sort = 'family_name') {
        if (sort === 'familyName') sort = 'family_name';
        return axios.get(`/api/people-list/?sort=${sort}&order=DESC&page=${page}`).then(res => res.data.members);
    },
    getListByLetter (letter) {
        return axios.get(`/api/people-list/?letter=${letter}`).then(res => res.data.members);
    },
    search (value) {
        return axios.get(`/api/people-list/?search=${value}`).then(res => res.data.members);
    }
};
