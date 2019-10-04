const axios = require('axios');

export default {
    getSubdistricts (district) {
        return axios.get(`/api/districts/${district}`).then(res => Object.keys(res.data));
    },
    getIndexes (district, subdist) {
        return axios.get(`/api/districts/${district}/${subdist}`).then(res => res.data);
    },
    getDistricts () {
        return axios.get('/api/districts/').then(res => res.data);
    },
};
