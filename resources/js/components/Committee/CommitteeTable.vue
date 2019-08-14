<script>
import Vue from 'vue';
import CommitteeTableItem from './CommitteeTableItem';
import CommitteeNavigation from './CommitteeNavigation';
import Sorting from '../Ux/Sorting';
import sortingMixin from '../../mixins/sortingMixin';

import checkView from 'vue-check-view';
Vue.use(checkView);

export default {
    name: 'SearchForm',
    mixins: [sortingMixin],
    props: {
        committees: {
            type: Array,
            default: () => []
        }
    },
    components: {
        CommitteeTableItem,
        CommitteeNavigation,
        Sorting
    },
    data() {
        return {
            committeesList: this.committees,
            sortedCommittees: [],
            filtered: false
        };
    },
    created () {
        this.sortByChar();
    },
    methods: {
        sortByChar() {
            this.sortedCommittees = [];
            let chars = [];
            this.committeesList
                .sort((a, b) => a.title === b.title ? 0 : +(a.title > b.title) || -1)
                .forEach(el => {
                    if (!chars.includes(el.title[0].toLowerCase())) {
                        chars.push(el.title[0].toLowerCase());
                        let arr = this.committeesList.filter(el => el.title[0].toLowerCase() === chars[chars.length - 1]);
                        this.sortedCommittees.push({
                            data: arr,
                            char: chars[chars.length - 1]
                        });
                    }
                });
        },
        filterList (value) {
            if (value) {
                this.sortedCommittees = this.committeesList
                    .filter(el => el.title.toLowerCase().includes(value.toLowerCase()));
                this.filtered = false;
            }
            else {
                this.sortByChar();
                this.filtered = true;
            }
        },
        viewHandler(e) {
            let id = e.target.element.id;
            if (id) {
                if (e.percentInView === 1 || e.percentTop > .2 && e.percentTop < .9) {
                    document.querySelector(`#${id[0]}-search-button`).classList.add('bolt');
                }
                else {
                    document.querySelector(`#${id[0]}-search-button`).classList.remove('bolt');
                }
            }
        },
    },
};
</script>

<template>
    <div class="ris-committee-list-wrapper">
        <div />
        <section class="ris-section-wrapper ris-content_six-eight-eight">
            <h1 class="ris-committee-list__headline ris-headline">Gremien</h1>
            <Sorting @input="filterList" @change="print" drop-label="Sortierung" drop-id="committee-drop" :dropOptions="['A-Z']" />
            <transition-group tag="ul" name="fade" class="ris-committee-list-main-list ris-ul" v-if="!filtered">
                <li v-for="item in sortedCommittees"
                    class="ris-committee-list-main-list__item"
                    :id="`${item.char}-list-element`"
                    v-view="viewHandler"
                    :key="item.char">
                    <h2 class="ris-committee-list-main-list__heading ris-h2">{{ item.char }}</h2>
                    <ul class="ris-ul ris-committee-list-secondary-list">
                        <CommitteeTableItem
                            class="ris-committee-list-secondary-list__item"
                            v-for="(committee, committeeIndex) in item.data"
                            :key="`${item.char}-${committeeIndex}`"
                            :committee="committee"/>
                    </ul>
                </li>
            </transition-group>
            <transition-group tag="ul" name="fade" class="ris-committee-list-main-list ris-ul" v-if="filtered">
                <CommitteeTableItem
                    class="ris-committee-list-secondary-list__item"
                    v-for="(item, index) in sortedCommittees"
                    :key="`${index}-filtered`"
                    :committee="item"/>
            </transition-group>
        </section>
        <CommitteeNavigation
            v-if="!filtered"
            class="ris-committee-list-navigation"
            :navigation-list="sortedCommittees"
                />
    </div>
</template>
