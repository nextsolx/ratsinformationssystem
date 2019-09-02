const axios = require('axios');

export default {
    getPaginationList (page = 1, sort = 'familyName') {
        if (sort === 'familyName') {
            sort = 'family_name';
            return axios.get(`/api/people-list/?sort=${sort}&page=${page}`).then(res => res.data);
        }
        return axios.get(`/api/people-list/?sort=${sort}&order=DESC&page=${page}`).then(res => res.data);
    },
    getListByLetter (letter, sort = 'familyName') {
        if (sort === 'familyName') sort = 'family_name';
        return axios.get(`/api/people-list/?sort=${sort}&letter=${letter}`).then(res => res.data);
    },
    search (value) {
        return axios.get(`/api/people-list/?search=${value}`).then(res => res.data.members);
    }
};
