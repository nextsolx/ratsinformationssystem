<script>
import Vue from 'vue';
import checkView from 'vue-check-view';
import CommitteeTableItem from './CommitteeTableItem';
import Dropdown from '../Ux/Dropdown';
import Search from '../Ux/Search';
import LetterNavigation from '../LetterNavigation';
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
        CommitteeTableItem,
        LetterNavigation,
        Dropdown,
        Search,
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
    methods: {
        viewHandler(e) {
            const { id } = e.target.element;
            if (id) {
                if (e.percentInView === 1 || (e.percentTop > 0.2 && e.percentTop < 0.9)) {
                    document.querySelector(`#${id[0]}-search-button`).classList.add('bolt');
                } else {
                    document.querySelector(`#${id[0]}-search-button`).classList.remove('bolt');
                }
            }
        },
    },
};
</script>

<template>
    <div class="ris-table-list-wrapper">
        <div />
        <section class="ris-section-wrapper ris-content_six-eight-eight">
            <h1 class="ris-table-list__headline ris-headline">Gremien</h1>
            <div class="ris-filter-wrapper">
                <Search v-model="inputValue" :hidden-mob="true" @input="filterList" />
                <Dropdown
                    label="Sortierung"
                    id="committee-drop"
                    :options="[{label:'A-Z', value:'A-Z'}]"
                    :full-width-mob="true"
                    v-model="dropValue" />
            </div>
            <transition-group tag="ul" name="fade" class="ris-table-list-main-list ris-ul" v-if="!filtered">
                <li v-for="item in sortedList"
                    class="ris-table-list-main-list__item"
                    :id="`${item.char}-list-element`"
                    v-view="viewHandler"
                    :key="item.char">
                    <h2 class="ris-table-list-main-list__heading ris-h2">{{ item.char }}</h2>
                    <ul class="ris-ul ris-table-list-secondary-list">
                        <CommitteeTableItem
                            class="ris-table-list-secondary-list__item"
                            v-for="(committee, index) in item.data"
                            :key="`${item.char}-${index}`"
                            :committee="committee"/>
                    </ul>
                </li>
            </transition-group>
            <transition-group tag="ul" name="fade" class="ris-table-list-main-list ris-ul" v-if="filtered">
                <CommitteeTableItem
                    class="ris-table-list-secondary-list__item"
                    v-for="(item, index) in filteredList"
                    :key="`${index}-filtered`"
                    :committee="item"/>
            </transition-group>
        </section>
        <LetterNavigation
            v-if="!filtered"
            :navigation-list="sortedList"
                />
    </div>
</template>
