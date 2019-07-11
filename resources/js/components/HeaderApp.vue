<script>
export default {
    name: 'HeaderApp',
    data() {
        return {
            navMobileActive: false
        };
    },
    methods: {
        close() {
            this.navMobileActive = !this.navMobileActive;
        }
    }
};
</script>