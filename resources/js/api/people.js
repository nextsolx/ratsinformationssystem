const axios = require('axios');

export default {
    getAll () {
        return axios.get('/api/people-list').then(res => res.data.data);
    },
};
