<script>
import Swiper from 'swiper';
import noticeMixin from '../mixins/NoticeMixin';

const axios = require('axios');

export default {
    name: 'ThemeList',
    mixins: [noticeMixin],
    data: () => ({
        activeFilter: false,
        loading: false,
        firstLoading: true,
        themeListNew: [],
        themeListProgress: [],
        themeListFinished: [],
        themeListNewCount: 0,
        themeListProgressCount: 0,
        themeListFinishedCount: 0,
        themeFirstBlock: '.ris-card-list__themes',
        themeListLimitUntil: 4,
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
            if (!this.loading) {
                this.loading = true;
                this.postcodeList = [];

                this.themeListNew = [];
                this.themeListProgress = [];
                this.themeListFinished = [];
                this.themeListNewCount = 0;
                this.themeListProgressCount = 0;
                this.themeListFinishedCount = 0;

                // collapse filter block when the district is selected
                this.collapseFilter();

                const currentSelectedDistrict = e.currentTarget.innerText.trim();
                this.selectedDistrictList.push(currentSelectedDistrict);

                this.removeDistrictFromList(currentSelectedDistrict);

                this.selectedDistrictList.forEach(currentDistrictName => {

                    axios
                        .get(`/api/topics?district=${currentDistrictName}`)
                        .then(res => {
                            if (res.data.data.length === 0) {
                                this.info(currentDistrictName, this.districtInfoDescription);
                            } else {
                                res.data.data.forEach((topic) => {
                                    if (topic.newTopic) {
                                        this.themeListNewCount++;

                                        if (this.themeListNew.length < 3) {
                                            this.themeListNew.push(topic);
                                        }
                                    } else if (topic.finished) {
                                        this.themeListFinishedCount++;

                                        if (this.themeListFinished.length < 3) {
                                            this.themeListFinished.push(topic);
                                        }
                                    } else {
                                        this.themeListProgressCount++;

                                        if (this.themeListProgress.length < 3) {
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
                                this.removeDefaultBlocks();
                                this.firstLoading = false;
                            }
                        });
                });

                this.scrollTo(this.themeFirstBlock);
            }
        },
        scrollTo(selector) {
            const el = document.querySelector(selector);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth'});
            }
        },
        removeDefaultBlocks() {
            const defaultBlocks = [
                this.$refs.defaultThemeListNewBlock,
                this.$refs.defaultThemeListProgressBlock,
                this.$refs.defaultThemeListFinishedBlock,
                this.$refs.defaultDistrictListBlock
            ];

            defaultBlocks.forEach(theme => {
                if (theme) {
                    theme.remove();
                }
            });
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
