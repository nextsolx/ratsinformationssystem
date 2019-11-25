const axios = require('axios');

export default {
    getSubdistricts (district) {
        district = encodeURIComponent(district);
        return axios.get(`/api/districts?district=${district}`).then(res => res.data);
    },
    getPostcodes (district, subdist) {
        district = district.replace(/\//, '-');
        district = encodeURIComponent(district);
        subdist = subdist.replace(/\//, '-');
        subdist = encodeURIComponent(subdist);
        return axios.get(`/api/districts?district=${district}&subDistrict=${subdist}`).then(res => res.data);
    },
    getDistricts () {
        return axios.get('/api/districts/').then(res => res.data);
    },
    getLocationLike (value, page = 1) {
        return axios.get(`/api/locations?q=${value}&page=${page}`).then(res => res.data);
    },
};
