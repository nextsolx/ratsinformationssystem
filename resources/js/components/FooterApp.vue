<script>
export default {
    name: 'FooterApp',
    methods: {
        backToTop() {
            const $el = document.querySelector('#_ris-calendar-headline');
            if ($el) {
                $el.scrollIntoView();
            }
        }
    },
};
</script>
