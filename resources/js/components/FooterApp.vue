<script>
export default {
    name: 'FooterApp',
    methods: {
        backToTop() {
            const $el = document.querySelector('.ris-content');
            if ($el) {
                $el.scrollIntoView({ behavior: 'smooth'});
            }
        }
    },
};
</script>
