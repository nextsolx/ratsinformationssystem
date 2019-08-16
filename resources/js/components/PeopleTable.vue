<script>
import Member from './Member';
import LetterNavigation from './LetterNavigation';
import sortingMixin from '../mixins/sortingMixin';
import Dropdown from './Ux/Dropdown';
import Search from './Ux/Search';
export default {
    name: 'PeopleTable',
    mixins: [sortingMixin],
    props: {
        members: {
            type: Array,
            default: () => []
        }
    },
    components: {
        Member,
        LetterNavigation,
        Dropdown,
        Search
    },
    data() {
        return {
            unfilteredList: this.members,
            inputValue: '',
            dropValue: {},
            filtered: false,
            filterValue: 'name'
        };
    },
    created () {
        this.sortBy(this.unfilteredList, 'name', true);
    },
};
</script>

<template>
    <div class="ris-committee-list-wrapper">
        <div />
        <section class="ris-section-wrapper ris-content_six-eight-eight">
            <h1 class="ris-committee-list__headline ris-headline">Gremien</h1>
            <div class="ris-filter-wrapper">
                <Search v-model="inputValue" :hidden-mob="true" @input="filterList" />
                <Dropdown
                    label="Sortierung"
                    id="committee-drop"
                    :options="[{label:'A-Z', value:'A-Z'}]"
                    :full-width-mob="true"
                    v-model="dropValue" />
            </div>
            <transition-group tag="ul" name="fade" class="ris-committee-list-main-list ris-ul" v-if="!filtered">
                <li v-for="item in sortedList"
                    class="ris-committee-list-main-list__item"
                    :id="`${item.char}-list-element`"
                    v-view="viewHandler"
                    :key="item.char">
                    <h2 class="ris-committee-list-main-list__heading ris-h2">{{ item.char }}</h2>
                    <ul class="ris-ul ris-committee-list-secondary-list">
                        <Member
                            class="ris-committee-list-secondary-list__item"
                            v-for="member in item.data"
                            :key="member.id"
                            :member="member"/>
                    </ul>
                </li>
            </transition-group>
            <transition-group tag="ul" name="fade" class="ris-committee-list-main-list ris-ul" v-if="filtered">
                <Member
                    class="ris-committee-list-secondary-list__item"
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
