<script>
export default {
    name: 'ThemeOverviewList',
    components: {
        'theme': () => import('./Theme'),
    },
    props: {
        themeListData: {
            type: Array,
            default: () => ([])

        },
        themeListDataCount: {
            type: Number,
            default: 0
        },
        themeListType: {
            type: String,
            default: ''
        },
        themeFirstLoading: {
            type: Boolean,
            default: true
        },
        themeTypeLink: {
            type: String,
            default: ''
        },
    },
    data: () => ({
        districtInfoDescription: 'There are no topics',
    }),
};
</script>

<template>
    <section class="ris-card-list ris-card-list__themes"
        v-if="!themeFirstLoading"
            >
        <div class="ris-title"
            v-if="themeListType === 'new'"
                >
            Neue Themen
        </div>
        <div class="ris-title"
            v-else-if="themeListType === 'progress'"
                >
            Kürzlich aktualisiert
        </div>
        <div class="ris-title"
            v-else-if="themeListType === 'finished'"
                >
            Kürzlich abgeschlossen
        </div>

        <theme
            :theme-list-data="themeListData"
            :theme-list-type="themeListType"
        >
        </theme>

        <a :href="themeTypeLink" class="ris-link ris-link_has-icon"
            title="Mehr anzeigen"
            v-if="themeListDataCount > 3"
                >
            Mehr anzeigen
        </a>

        <div class="ris-body-1"
            v-if="themeListData.length === 0"
                >
            {{ districtInfoDescription }}
        </div>
    </section>
</template>
