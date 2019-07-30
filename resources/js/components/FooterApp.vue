<script>
export default {
    name: 'FooterApp',
    methods: {
        backToTop() {
            const $el = document.querySelector('.ris-main');
            if ($el) {
                $el.scrollIntoView({ behavior: 'smooth'});
            }
        }
    },
};
</script>
