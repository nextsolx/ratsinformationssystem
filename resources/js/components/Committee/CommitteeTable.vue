<script>
import Vue from 'vue';
import checkView from 'vue-check-view';
import sortingMixin from '../../mixins/sortingMixin';

Vue.use(checkView);

export default {
    name: 'CommitteeTable',
    mixins: [sortingMixin],
    props: {
        committees: {
            type: Array,
            default: () => [],
        },
    },
    components: {
        UiSearch: () => import('../Ui/UiSearch'),
        UiDropdown: () => import('../Ui/UiDropdown'),
        CommitteeTableItem: () => import('./CommitteeTableItem'),
        LetterNavigation: () => import('../LetterNavigation'),
    },
    data() {
        return {
            unfilteredList: this.committees,
            filtered: false,
            inputValue: '',
            dropValue: { label: 'A-Z', value: 'A-Z' },
            filterValue: 'title',
        };
    },
    created () {
        this.sortBy(this.unfilteredList, this.filterValue, true);
    },
    computed: {
        letterNavigationList() {
            const letterList = [];
            this.sortedList.map(el => letterList.push(el.title));
            return letterList;
        }
    },
    methods: {
        viewHandler(e) {
            const { id } = e.target.element;
            if (id) {
                const searchButton = document.querySelector(`#${id[0]}-search-button`);
                if (searchButton) {
                    if (e.percentInView === 1 || (e.percentTop > 0.2 && e.percentTop < 0.9)) {
                        searchButton.classList.add('bolt');
                    } else {
                        searchButton.classList.remove('bolt');
                    }
                }
            }
        },
    },
};
</script>

<template>
    <div class="ris-table-list-wrapper">
        <section class="ris-section-wrapper ris-content_six-eight-eight">
            <h1 class="ris-table-list__headline ris-headline">Gremien</h1>
            <div class="ris-filter-wrapper">
                <ui-search class="ris-table-list__input"
                    v-model="inputValue"
                    :hidden-mob="false"
                    @input="filterList" />
                <ui-dropdown
                    label="Sortierung"
                    id="committee-drop"
                    :options="[{label:'A-Z', value:'A-Z'}]"
                    :full-width-mob="true"
                    style="display: none"
                    v-model="dropValue" />
            </div>
            <transition-group tag="ul" name="fade" class="ris-table-list-main-list ris-ul" v-if="!filtered">
                <li v-for="item in sortedList"
                    class="ris-table-list-main-list__item"
                    :id="`${item.title}-list-element`"
                    v-view="viewHandler"
                    :key="item.title">
                    <h2 class="ris-table-list-main-list__heading ris-h2">{{ item.title }}</h2>
                    <ul class="ris-ul ris-table-list-secondary-list">
                        <committee-table-item
                            class="ris-table-list-secondary-list__item"
                            v-for="(committee, index) in item.data"
                            :key="`${item.title}-${index}`"
                            :committee="committee"/>
                    </ul>
                </li>
            </transition-group>
            <transition-group tag="ul" name="fade" class="ris-table-list-main-list ris-ul" v-if="filtered">
                <committee-table-item
                    class="ris-table-list-secondary-list__item"
                    v-for="(item, index) in filteredList"
                    :key="`${index}-filtered`"
                    :committee="item"/>
            </transition-group>
        </section>
        <letter-navigation
            :is-showed="!filtered"
            :navigation-list="letterNavigationList"
                />
    </div>
</template>
