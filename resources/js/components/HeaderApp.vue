<script>
export default {
    name: 'HeaderApp',
    components: {
        GlobalSearch: () => import('./GlobalSearch'),
    },
    data() {
        return {
            navMobileActive: false
        };
    },
    methods: {
        close() {
            this.navMobileActive = !this.navMobileActive;

            this.$emit('nav-active', this.navMobileActive);
        }
    }
};
</script>
