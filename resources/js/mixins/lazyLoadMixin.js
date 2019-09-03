export default {
    data() {
        return {
            lazyLoading: true,
            lazyLoadingDebounce: null
        };
    },
    mounted() {
        this.scroll();
    },
    methods: {
        scroll() {
            window.addEventListener('scroll', this.scrollListener);
        },
        scrollListener() {
            let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;
            if (bottomOfWindow && this.lazyLoading) {
                this.lazyLoadingDebounce && clearTimeout(this.lazyLoadingDebounce);
                this.lazyLoadingDebounce = setTimeout( () => this.lazyHandle(), 500);
            }
        }
    },
    beforeDestroy() {
        window.removeEventListener('scroll', this.scrollListener);
    }
};

