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
    getDistrictsByAPI() {
        const config = {
            headers: {
                'Access-Control-Allow-Origin': '*',
                'Access-Control-Allow-Methods': 'PUT, GET, POST, DELETE, OPTIONS',
                'Access-Control-Allow-Headers': 'Origin, X-Requested-With, Content-Type, Accept, Authorization',
                crossdomain: true,
                'Content-Type': 'application/json',
            }
            /*headers: {
                "content-type": "application/javascript", "cache-control": "max-age=15", "content-length": "670", "expires": "Thu, 03 Oct 2019 16:54:07 UTC" },
            config: {
                "transformRequest": {},
                "transformResponse": {},
                "timeout": 0,
                "xsrfCookieName": "XSRF-TOKEN",
                "xsrfHeaderName": "X-XSRF-TOKEN",
                "maxContentLength": -1,
                "headers": {"Accept": "application/json, text/plain, *!/!*"},
            }*/
        /*{
            res.header("Access-Control-Allow-Origin", "*");
            res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
        }*/
        };
        return axios.get(
                'https://geoportal.stadt-koeln.de/arcgis/rest/services/Stadtgebiet/MapServer/0/query?where=objectid+is+not+null&text=&objectIds=&time=&geometry=&geometryType=esriGeometryEnvelope&inSR=&spatialRel=esriSpatialRelIntersects&relationParam=&outFields=*&returnGeometry=true&returnTrueCurves=false&maxAllowableOffset=&geometryPrecision=&outSR=4326&returnIdsOnly=false&returnCountOnly=false&orderByFields=&groupByFieldsForStatistics=&outStatistics=&returnZ=false&returnM=false&gdbVersion=&returnDistinctValues=false&resultOffset=&resultRecordCount=&f=json',
                config
            )
            .then(res => {
                console.log(res.data);

                return res.data
            })
            .catch(error => console.log(error));
    }
};
