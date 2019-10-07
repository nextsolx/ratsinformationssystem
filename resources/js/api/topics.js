const axios = require('axios');

export default {
    getPaginationList (type, page = 1) {
        return axios.get(`/api/topics/?scope=${type}&page=${page}`).then(res => res.data);
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
    getTopicsLike (value, page = 1) {
        return axios.get(`/api/topics?q=${value}&page=${page}`).then(res => res.data);
    }
};
