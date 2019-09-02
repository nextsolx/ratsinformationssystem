<script>
import Swiper from 'swiper';
import noticeMixin from '../mixins/NoticeMixin';

const axios = require('axios');

export default {
    name: 'ThemeOverview',
    mixins: [noticeMixin],
    data: () => ({
        activeFilter: false,
        loading: false,
        firstLoading: true,
        themeListNew: [],
        themeListProgress: [],
        themeListFinished: [],
        themeFirstBlock: '.ris-card-list__themes',
        postcodeList: [],
        selectedDistrictList: [],
        districtList: [],
        districtInfoDescription: 'There are no topics',
        postcodeInfoDescription: 'There are no topics for the selected postcode',
    }),
    props: {
        defaultDistrictList: {
            type: Array,
            default: () => [],
        },
    },
    methods: {
        collapseFilter() {
            this.activeFilter = !this.activeFilter;
        },
        getTopicByDistrict(e) {
            if (this.loading) {
                return;
            }

            this.loading = true;
            this.postcodeList = [];

            this.themeListNew = [];
            this.themeListProgress = [];
            this.themeListFinished = [];

            // collapse filter block when the district is selected
            this.collapseFilter();

            const currentSelectedDistrict = e.currentTarget.innerText.trim();
            this.selectedDistrictList.push(currentSelectedDistrict);

            this.removeDistrictFromList(currentSelectedDistrict);

            this.selectedDistrictList.forEach(currentDistrictName => {

                axios
                    .get(`/api/topics?district=${currentDistrictName}`)
                    .then(res => {
                        if (res.data.data.length > 0) {
                            res.data.data.forEach((topic) => {
                                if (topic.newTopic) {
                                    if (this.themeListNew.length < 10) {
                                        this.themeListNew.push(topic);
                                    }
                                } else if (topic.finished) {
                                    if (this.themeListFinished.length < 10) {
                                        this.themeListFinished.push(topic);
                                    }
                                } else {
                                    if (this.themeListProgress.length < 10) {
                                        this.themeListProgress.push(topic);
                                    }
                                }

                                // for filter block
                                if (topic.location.postalCode) {
                                    if (!this.postcodeList.includes(topic.location.postalCode)) {
                                        this.postcodeList.push(topic.location.postalCode);
                                    }
                                }
                            });
                        }
                    })
                    .finally(() => {
                        this.loading = false;

                        if (this.firstLoading) {
                            this.firstLoading = false;
                        }
                    });
            });

            this.scrollTo(this.themeFirstBlock);
        },
        scrollTo(selector) {
            const el = document.querySelector(selector);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth'});
            }
        },
        removeDistrictFromList(district) {
            if (this.districtList.includes(district)) {
                const districtIndex = this.districtList.indexOf(district);
                this.districtList.splice(districtIndex, 1);
            }
        },
        removeSelectedDistrict(district) {
            if (this.selectedDistrictList.includes(district)) {
                const selectedDistrictIndex = this.selectedDistrictList.indexOf(district);
                this.selectedDistrictList.splice(selectedDistrictIndex, 1);

                this.updateDistrictList();
            }
        },
        updateDistrictList() {
            this.districtList = this.defaultDistrictList.slice(0);

            this.selectedDistrictList.forEach(selectedDistrict => {
                if (this.districtList.includes(selectedDistrict)) {
                    const districtIndex = this.districtList.indexOf(selectedDistrict);
                    this.districtList.splice(districtIndex, 1);
                }
            });

            this.scrollTo(this.themeFirstBlock);
            this.collapseFilter();
        },
    },
    mounted() {
        if (this.defaultDistrictList) {
            this.districtList = this.defaultDistrictList.slice(0);
        }

        new Swiper ('.swiper-container', {
            slidesPerView: 3,
            spaceBetween: 16,

            breakpoints: {
                /*1920: {
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
                },*/
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
