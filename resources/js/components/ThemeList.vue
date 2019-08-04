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
        districtList: [],
        postcodeList: [],
        currentDistrictNameList: [],
        districtInfoDescription: 'There are no topics',
        postcodeInfoDescription: 'There are no topics for the selected postcode',
    }),
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

                // collapse filter block when choose some filter
                this.activeFilter = false;

                this.currentDistrictNameList.push(e.currentTarget.innerText.trim());

                const filterSelectedBlock = this.$refs.filterSelected;

                this.currentDistrictNameList.forEach(currentDistrictName => {
                    if (filterSelectedBlock) {
                        filterSelectedBlock.style.display = 'block';
                        filterSelectedBlock.innerHTML += `
                            <button class="ris-label"
                                @click="removeSelectFilter(${currentDistrictName})"
                            >${currentDistrictName}</button>`;
                    }

                    axios
                        .get(`/api/topics?district=${currentDistrictName}`)
                            .then(res => {
                                if (res.data.data.length === 0) {
                                    this.info(currentDistrictName, this.districtInfoDescription);
                                } else {
                                    this.scrollTo(this.themeFirstBlock);

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
                                    this.removeDefaultThemeList();
                                    this.firstLoading = false;
                                }
                            });
                });
            }
        },
        scrollTo(selector) {
            const el = document.querySelector(selector);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth'});
            }
        },
        removeDefaultThemeList() {
            const themeListDefault = [
                this.$refs.themeListNewBlock,
                this.$refs.themeListProgressBlock,
                this.$refs.themeListFinishedBlock
            ];

            themeListDefault.forEach(theme => {
                if (theme) {
                    theme.remove();
                }
            });
        },
        removeSelectFilter(filter) {
            //this.currentDistrictNameList = [];
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
