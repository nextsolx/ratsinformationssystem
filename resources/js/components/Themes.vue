<script>
import Swiper from 'swiper';

export default {
    name: 'Themes',
    data: () => ({
        activeFilter: false,
    }),
    methods: {
        collapseFilter() {
            this.activeFilter = !this.activeFilter;
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
