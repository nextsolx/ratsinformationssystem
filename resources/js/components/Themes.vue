<script>
import Swiper from 'swiper';
import Vue from 'vue';

const axios = require('axios');
const moment = require('moment');
require('moment/locale/de');

Vue.use(require('vue-moment'), {
    moment
});

import noticeMixin from '../mixins/NoticeMixin';

export default {
    name: 'Themes',
    mixins: [noticeMixin],
    data: () => ({
        activeFilter: false,
        //emptyTopicList: false,
        loading: false,
        topicList: [],
        districtList: [],
        postcodeList: [],
        districtInfoTitle: 'There are no topics for the selected district',
        postcodeInfoTitle: 'There are no topics for the selected postcode',
    }),
    methods: {
        collapseFilter() {
            this.activeFilter = !this.activeFilter;
        },
        getTopicByDistrict(e) {
            if (!this.loading) {
                this.loading = true;
                const district = (e.currentTarget.innerText).trim();

                axios
                    .get(`/api/topics?district=${district}`)
                    .then(res => {
                        this.topicList = res.data.data;

                        if (res.data.data.length === 0) {
                            this.info(this.districtInfoTitle);
                        }
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            }
        }
    },
    mounted() {
        new Swiper ('.swiper-container', {
            slidesPerView: 8,
            spaceBetween: 16,

            breakpoints: {
                1920: {
                    slidesPerView: 7
                },
                1440: {
                    slidesPerView: 6
                },
                1280: {
                    slidesPerView: 5
                },
                1024: {
                    slidesPerView: 3
                },
                768: {
                    slidesPerView: 3
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 8,
                },
                425: {
                    slidesPerView: 'auto',
                    spaceBetween: 8,
                }
            }
        });
    },
};
</script>
