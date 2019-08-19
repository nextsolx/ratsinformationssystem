<script>
import Member from './Member';
import LetterNavigation from './LetterNavigation';
import sortingMixin from '../mixins/sortingMixin';
import Dropdown from './Ux/Dropdown';
import Search from './Ux/Search';
import people from '../api/people';

export default {
    name: 'PeopleTable',
    mixins: [sortingMixin],
    components: {
        Member,
        LetterNavigation,
        Dropdown,
        Search,
    },
    data() {
        return {
            unfilteredList: this.members,
            inputValue: '',
            dropValue: {label:'A-Z', value:'A-Z'},
            filtered: false,
            filterValue: 'familyName',
        };
    },
    async created () {
        this.unfilteredList = await people.getAll();
        this.sortBy(this.unfilteredList, 'familyName', true);
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
        }
    }
};
</script>

<template>
    <div class="ris-table-list-wrapper">
        <div />
        <section class="ris-section-wrapper ris-content_six-eight-eight">
            <h1 class="ris-table-list__headline ris-headline">Personen</h1>
            <div class="ris-filter-wrapper">
                <Search v-model="inputValue" :hidden-mob="true" @input="filterList" />
                <Dropdown
                    label="Sortierung"
                    id="table-drop"
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
                        <Member
                            class="ris-table-list-secondary-list__item"
                            v-for="member in item.data"
                            :key="member.id"
                            :member="member"/>
                    </ul>
                </li>
            </transition-group>
            <transition-group tag="ul" name="fade" class="ris-table-list-main-list ris-ul" v-if="filtered">
                <Member
                    class="ris-table-list-secondary-list__item"
                    v-for="member in filteredList"
                    :key="`${member.id}-filtered`"
                    :member="member"/>
            </transition-group>
        </section>
        <LetterNavigation
            v-if="!filtered"
            :navigation-list="sortedList"
                />
    </div>
</template>
