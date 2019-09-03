const axios = require('axios');

export default {
    getPaginationList (type, page = 1) {
        return axios.get(`/api/topics/?scope=${type}&page=${page}`).then(res => res.data);
    }
};
