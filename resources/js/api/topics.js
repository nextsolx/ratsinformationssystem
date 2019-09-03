const axios = require('axios');

export default {
    getPaginationList (page = 1) {
        return axios.get(`/api/topics/?page=${page}`).then(res => res.data);
    }
};
