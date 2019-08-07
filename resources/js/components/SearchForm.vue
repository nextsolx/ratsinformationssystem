<script>
export default {
    name: 'SearchForm',
    props: {
        committees: {
            type: Array,
            default: ()=> []
        }
    },
    data() {
        return {
            inputValue: '',
            sortedCommittees: []
        };
    },
    created () {
        this.sortByChar();
    },
    methods: {
        sortByChar() {
            let char = ''
            this.committees
                .sort((a, b) => a.title === b.title ? 0 : +(a.title > b.title) || -1)
                .forEach(el => {
                    if (!this.sortedCommittees.length || char !== el.title[0]) {
                        char = el.title[0];
                        let arr = this.committees.filter(el => el.title[0] === char);
                        this.sortedCommittees.push({
                            data: arr,
                            char
                        });
                    }
                });
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
        <ul class="ris-committee-main-list ris-ul">
            <li v-for="(item, index) in sortedCommittees"
                class="ris-committee-main-list__item"
                :key="index">
                <h2 class="ris-committee-main-list__heading ris-h2">{{ item.char }}</h2>
                <ul class="ris-ul ris-committee-secondary-list">
                    <li v-for="(committe, committeIndex) in item.data"
                        class="ris-committee-secondary-list__item"
                        :key="`${item.char}-${committeIndex}`">
                        <a href="#" class="ris-committee__link">
                            <h3 class="ris-h3">{{ committe.title }}</h3>
                            <span class="ris-committee-secondary-list__item-wrapper">
                                <span>{{ committe.memberCount }}</span>
                                <time>{{ committe.nextMeetingDate }}</time>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>
