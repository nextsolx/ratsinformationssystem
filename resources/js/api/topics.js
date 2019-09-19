const axios = require('axios');

export default {
    getPaginationList (type, page = 1) {
        return axios.get(`/api/topics/?scope=${type}&page=${page}`).then(res => res.data);
    },
    getTopicsByProgress (page = 1, filterQueryParams = '') {
        return axios.get(`/api/topics/progress/?page=${page}${filterQueryParams}`).then(res => res.data);
    },
    getTopicsByNew (page = 1, filterQueryParams = '') {
        return axios.get(`/api/topics/new/?page=${page}${filterQueryParams}`).then(res => res.data);
    },
    getTopicById (id) {
        return axios.get(`/api/topic/${id}`).then(res => res.data);
    },
    getTopicsByDistrictList (district, page = 1) {
        return axios.get(`/api/topics/?district=${district}&page=${page}`).then(res => res.data);
    },
    getTopicsByIndexList (index, page = 1) {
        return axios.get(`/api/topics/?postalCode=${index}&page=${page}`).then(res => res.data);
    },
};
