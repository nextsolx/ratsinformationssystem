export default {
    data() {
        return {
            lazyLoading: true
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
            if (bottomOfWindow && this.lazyLoading) this.lazyHandle();
        }
    },
    beforeDestroy() {
        window.removeEventListener('scroll', this.scrollListener);
    }
};

