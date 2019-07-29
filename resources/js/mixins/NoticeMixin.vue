<script>
export default {
    name: 'NoticeMixin',
    methods: {
        info (title = null, description = null) {
            this.$Notice.info({
                title: title,
                desc: description
            });
        },
        success (title = null, description = null) {
            this.$Notice.success({
                title: title,
                desc: description
            });
        },
        warning (title = null, description = null) {
            this.$Notice.warning({
                title: title,
                desc: description
            });
        },
        error (title = null, description = null) {
            this.$Notice.error({
                title: title,
                desc: description
            });
        }
    }
};
</script>
