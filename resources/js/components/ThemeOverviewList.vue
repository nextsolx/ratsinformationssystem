<script>
import Theme from './Theme';

export default {
    name: 'ThemeOverviewList',
    components: {
        Theme
    },
    props: {
        themeListData: {
            type: Array,
            default: () => ([])
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
    <section class="ris-section-wrapper ris-card-list ris-card-list__themes"
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
                />

        <a :href="themeTypeLink" class="ris-link ris-link_button ris-link_right"
            title="Mehr anzeigen"
            v-if="themeListData.length > 3"
                >
            Mehr anzeigen
            <span class="ris-i ris-i_chevron-right"/>
        </a>

        <div class="ris-body-1"
            v-if="themeListData.length === 0"
                >
            {{ districtInfoDescription }}
        </div>
    </section>
</template>
