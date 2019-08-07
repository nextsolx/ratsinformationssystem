<script>
export default {
    name: 'SearchForm',
    props: {
        committees: {
            type: Array,
            default: () => []
        }
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
            let char = ''
            this.committeesList
                .sort((a, b) => a.title === b.title ? 0 : +(a.title > b.title) || -1)
                .forEach(el => {
                    if (!this.sortedCommittees.length || char !== el.title[0].toLowerCase()) {
                        char = el.title[0].toLowerCase();
                        let arr = this.committeesList.filter(el => el.title[0].toLowerCase() === char);
                        this.sortedCommittees.push({
                            data: arr,
                            char
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
        scrollToComponents(id) {
            const $el = document.querySelector(`#${id}-list-element`);
            if ($el) {
                $el.scrollIntoView({ behavior: 'smooth'});
            }
        }
    }
};
</script>

<template>
    <div>
        <div class="ris-committee__wrapper">
            <div class="ris-search ris-committee__search">
                <button class="ris-search__button"/>
                <input type="search" class="ris-search__input" v-model="inputValue"
                    @input="filterList"
                    placeholder="Suche nach Themen, Vorlagen, Sitzungen..."
                        >
            </div>
            <div class="ris-select ris-committee__select">
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
        <nav v-if="!filtered" class="ris-committee-navigation">
            <ul class="ris-ul ris-committee-navigation__list">
                <li
                    v-for="(item, index) in sortedCommittees"
                    class="ris-committee-navigation__item"
                    :key="`${index}-list-button`">
                    <button
                        @click="scrollToComponents(item.char)"
                        class="ris-committee-navigation__button">
                        {{ item.char }}
                    </button>
                </li>
            </ul>
        </nav>
        <ul class="ris-committee-main-list ris-ul" v-if="!filtered">
            <li v-for="(item, index) in sortedCommittees"
                class="ris-committee-main-list__item"
                :id="`${item.char}-list-element`"
                :key="index">
                <h2 class="ris-committee-main-list__heading ris-h2">{{ item.char }}</h2>
                <ul class="ris-ul ris-committee-secondary-list">
                    <li v-for="(committe, committeIndex) in item.data"
                        class="ris-committee-secondary-list__item"
                        :key="`${item.char}-${committeIndex}`">
                        <a href="#" class="ris-committee__link">
                            <h3 class="ris-h3">{{ committe.title }}</h3>
                            <span class="ris-committee-secondary-list__item-wrapper">
                                <span class="ris-committee-secondary-list__counter">{{ committe.memberCount }}</span>
                                <time class="ris-committee-secondary-list__time">{{ committe.nextMeetingDate }}</time>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="ris-committee-main-list ris-ul" v-if="filtered">
            <li v-for="(item, index) in sortedCommittees"
                class="ris-committee-secondary-list__item"
                :key="`${index}-filtered`">
                <a href="#" class="ris-committee__link">
                    <h3 class="ris-h3">{{ item.title }}</h3>
                    <span class="ris-committee-secondary-list__item-wrapper">
                        <span class="ris-committee-secondary-list__counter">{{ item.memberCount }}</span>
                        <time class="ris-committee-secondary-list__time">{{ item.nextMeetingDate }}</time>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</template>
