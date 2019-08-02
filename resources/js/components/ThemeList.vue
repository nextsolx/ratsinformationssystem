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
        themeListNew: [],
        themeListProgress: [],
        themeListFinished: [],
        themeListNewSelector: '._theme-list-new-block',
        themeListProgressSelector: '._theme-list-progress-block',
        themeListFinishedSelector: '._theme-list-finished-block',
        themeNewDefault: '._theme-new-default',
        themeProgressDefault: '._theme-progress-default',
        themeFinishedDefault: '._theme-finished-default',
        themeListLimitUntil: 4,
        districtList: [],
        postcodeList: [],
        districtInfoTitle: 'There are no topics',
        postcodeInfoTitle: 'There are no topics for the selected postcode',
    }),
    methods: {
        collapseFilter() {
            this.activeFilter = !this.activeFilter;
        },
        getTopicByDistrict(e) {
            if (!this.loading) {
                this.loading = true;
                this.postcodeList = [];
                const district = (e.currentTarget.innerText).trim();

                axios
                    .get(`/api/topics?district=${district}`)
                    .then(res => {
                        if (res.data.data.length === 0) {
                            this.info(district, this.districtInfoTitle);
                            this.hideShowThemeListBlocks('none');
                        } else {
                            this.scrollTo(this.themeListNewSelector);
                            this.hideShowThemeListBlocks('block');
                            this.removeDefaultThemeList();

                            res.data.data.forEach((topic) => {
                                if (topic.newTopic && this.themeListNew.length < 3) {
                                    this.themeListNew.push(topic);
                                } else if (topic.finished && this.themeListFinished < 3) {
                                    this.themeListFinished.push(topic);
                                } else {
                                    if (this.themeListProgress < 3) {
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
            const themeListDefault = [this.themeNewDefault,
                this.themeProgressDefault,
                this.themeFinishedDefault];
            themeListDefault.forEach(theme => {
                const themeTag = document.querySelectorAll(theme);
                if (themeTag) {
                    themeTag.forEach(item => item.remove());
                }
            });
        },
        hideShowThemeListBlocks(displayValue) {
            const themeListDefault = [this.themeListNewSelector,
                this.themeListProgressSelector,
                this.themeListFinishedSelector];
            themeListDefault.forEach(theme => {
                const themeTag = document.querySelectorAll(theme);
                if (themeTag) {
                    themeTag.forEach(item => item.style.display = displayValue);
                }
            });
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
