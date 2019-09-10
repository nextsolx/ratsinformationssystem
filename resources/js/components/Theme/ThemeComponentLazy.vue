<script>
import { ContentLoader } from 'vue-content-loader';
import lazyLoadMixin from '../../mixins/lazyLoadMixin';
import topics from '../../api/topics';
import ThemeComponent from './ThemeComponent';

export default {
    name: 'ThemeComponentLazy',
    mixins: [lazyLoadMixin],
    components: {
        ContentLoader,
        ThemeComponent,
    },
    props: {
        themeListType: {
            type: String,
            default: ''
        },
    },
    data() {
        return {
            loading: false,
            paginationPage: 1,
            unfilteredList: [],
        };
    },
    methods: {
        async getDataByFilter() {
            if (!this.loading) {
                this.loading = true;

                this.paginationPage++;
                const {data} = await topics.getPaginationList(this.themeListType, this.paginationPage);

                this.unfilteredList = [...this.unfilteredList, ...data];
                this.loading = false;
            }
        },
        lazyHandle () {
            this.getDataByFilter();
        },
    }
};
</script>

<template>
    <div>
        <theme-component
            :theme-list-data="this.unfilteredList"
            :theme-list-type="themeListType"
                />

        <content-loader v-if="loading"
            :primary-color="'#dadce0'"
            :height="100"
                >
            <rect x="5" y="15" rx="4" ry="4" width="20" height="6" />
            <rect x="5" y="30" rx="4" ry="4" width="20" height="6" />

            <rect x="42" y="15" rx="3" ry="3" width="346" height="6" />
            <rect x="42" y="30" rx="3" ry="3" width="346" height="6" />

            <rect x="40" y="52" rx="3" ry="3" width="25" height="6" />
            <rect x="95" y="52" rx="3" ry="3" width="25" height="6" />
            <rect x="145" y="52" rx="3" ry="3" width="25" height="6" />

            <rect x="40" y="80" rx="3" ry="3" width="130" height="6" />
        </content-loader>
    </div>
</template>
