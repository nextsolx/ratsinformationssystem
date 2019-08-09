<script>
import Vue from 'vue';
import CommitteeTableItem from './CommitteeTableItem';
import CommitteeNavigation from './CommitteeNavigation';

import checkView from 'vue-check-view';
Vue.use(checkView);

export default {
    name: 'SearchForm',
    props: {
        committees: {
            type: Array,
            default: () => []
        }
    },
    components: {
        CommitteeTableItem,
        CommitteeNavigation
    },
    data() {
        return {
            inputValue: '',
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
        filterList (e) {
            let value = e.target.value;
            if (value) {
                this.sortedCommittees = this.committeesList
                    .filter(el => el.title.toLowerCase().includes(value.toLowerCase()));
                this.filtered = true;
            }
            else {
                this.sortedCommittees = [];
                this.sortByChar();
                this.filtered = false;
            }
        },
        viewHandler(e) {
            if (e.percentInView === 1 || e.percentTop > .2 && e.percentTop < .9) {
                document.querySelector(`#${e.target.element.id[0]}-search-button`).classList.add('bolt');
            }
            else {
                document.querySelector(`#${e.target.element.id[0]}-search-button`).classList.remove('bolt');
            }
        }
    }
};
</script>

<template>
    <div class="ris-committee-list-wrapper">
        <div />
        <section class="ris-section-wrapper ris-content_six-eight-eight">
            <h1 class="ris-committee-list__headline ris-headline">Gremien</h1>
            <div class="ris-committee-list__wrapper">
                <div class="ris-search ris-committee-list__search">
                    <button class="ris-search__button"/>
                    <input type="search" class="ris-search__input" v-model="inputValue"
                        @input="filterList"
                        placeholder="Suche nach Themen, Vorlagen, Sitzungen..."
                            >
                </div>
                <div class="ris-select ris-committee-list__select">
                    <div class="ris-select__label">Darstellung</div>

                    <select class="ris-select__select">
                        <option class="ris-select__option" data-sort-type="newest-first">
                            Das Neuste zuerst
                        </option>
                        <option class="ris-select__option" data-sort-type="oldest-first">
                            Chronologische Reihenfolge
                        </option>
                    </select>
                </div>
            </div>
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
