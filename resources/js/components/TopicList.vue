<script>
import lazyLoadMixin from '../mixins/lazyLoadMixin';
import topics from '../api/topics';
import Theme from './Theme';
export default {
    name: 'TopicList',
    mixins: [lazyLoadMixin],
    components: {
        Theme
    },
    data() {
        return {
            loading: false,
            paginationPage: 1,
            unfilteredList: []
        };
    },
    methods: {
        async getDataByFilter() {
            this.loading = true;
            const { data } = await topics.getPaginationList(this.paginationPage);
            this.unfilteredList = [...this.unfilteredList, ...data];
            this.loading = false;
        },
        lazyHandle () {
            this.paginationPage++;
            this.getDataByFilter();
        },
    }
};
</script>

<template>
    <Theme :theme-list-data="this.unfilteredList" />
</template>
