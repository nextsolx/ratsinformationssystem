<script>
import noticeMixin from '../../mixins/NoticeMixin';

import topics from '../../api/topics';

export default {
    name: 'ThemeList',
    mixins: [noticeMixin],
    data: () => ({
        themeSortedList: [],
        dropValue: {label: 'Einstellungsdatum', value: 'date'},
        loading: false,
    }),
    methods: {
        async changeThemeList(selectedSortType) {
            if (!this.loading) {
                console.log('loading start');
                let theme = '';
                this.loading = true;

                if (selectedSortType.value) {
                    console.log('loading some value');

                    if (selectedSortType.value === 'progress') {
                        theme = await topics.getTopicsByProgress();
                    } else {
                        theme = await topics.getTopicsByNew();
                    }

                    console.log('loaded data');

                    this.loading = false;
                    this.dropValue = {label: selectedSortType.label, value: selectedSortType.value};

                    if (theme.data) {
                        theme.data.map(theme => {
                            this.themeSortedList.push(theme);
                        });
                    }
                }
            }
        },
    },
};
</script>
