<script>
import Vue from 'vue';
import checkView from 'vue-check-view';
import sortingMixin from '../../mixins/sortingMixin';
import lazyLoadMixin from '../../mixins/lazyLoadMixin';
import people from '../../api/people';

Vue.use(checkView);

export default {
    name: 'PeopleTable',
    mixins: [sortingMixin, lazyLoadMixin],
    components: {
        MemberItem: () => import('../Member/MemberItem'),
        LetterNavigation: () => import('../LetterNavigation'),
        UiDropdown: () => import('../Ui/UiDropdown'),
        UiSearch: () => import('../Ui/UiSearch'),
        ContentLoader: () => import('vue-content-loader').then(({ContentLoader}) => ContentLoader),
    },
    data() {
        return {
            unfilteredList: [],
            inputValue: '',
            dropValue: {label:'Nachname', value:'familyName'},
            filtered: false,
            filterValue: 'familyName',
            paginationPage: 1,
            loading: false,
            debounce: null
        };
    },
    created () {
        this.getDataByFilter();
    },
    methods: {
        viewHandler(e) {
            const { id } = e.target.element;
            if (id && this.lazyLoading) {
                const searchButton = document.querySelector(`#${id[0]}-search-button`);
                if (searchButton) {
                    if (e.percentInView === 1 || (e.percentTop > 0.1 && e.percentTop < 0.9) || e.type === 'progress' || e.type === 'enter') {
                        searchButton.classList.add('bolt');
                    } else {
                        searchButton.classList.remove('bolt');
                    }
                }
            }
        },
        async getDataByFilter () {
            this.loading = true;
            const { members } = await people.getPaginationList(this.paginationPage, this.filterValue);
            this.unfilteredList = [...this.unfilteredList, ...members];
            this.sortBy(this.unfilteredList, this.filterValue, true);
            this.loading = false;
        },
        changeFilterValue (obj) {
            this.filterValue = obj.value;
            this.paginationPage = 1;
            this.lazyLoading = true;
            this.unfilteredList = [];
            this.sortedList = [];
            this.getDataByFilter();
        },
        searchPeople (value) {
            if (value) {
                this.lazyLoading = false;
                this.paginationPage = 1;
                this.filtered = true;
                this.filteredList = [];
                this.loading = true;
                this.debounce && clearTimeout(this.debounce);
                this.debounce = setTimeout(
                    async () => {
                        const { members } = await people.getPeopleLike(value);
                        this.filteredList = members;
                        this.loading = false;
                    }, 1000);
            } else {
                this.paginationPage = 1;
                this.filtered = false;
                this.lazyLoading = true;
            }
        },
        async buttonHandle (letter) {
            this.lazyLoading = false;
            this.loading = true;
            this.sortedList = [];
            this.dropValue = {label:'Nachname', value:'familyName'};
            const { members } = await people.getListByLetter(letter, this.dropValue.value);
            this.sortBy(members, 'familyName', true);
            this.loading = false;
            document.querySelectorAll('.ris-letter-nav__button').forEach(el => {
                if (el.id === `${letter}-search-button`) {
                    el.classList.add('bolt');
                }
                else {
                    el.classList.remove('bolt');
                }
            });
        },
        lazyHandle () {
            this.paginationPage++;
            this.getDataByFilter();
        },
    },
};
</script>

<template>
    <div class="ris-table-list-wrapper">
        <section class="ris-section-wrapper ris-content_six-eight-eight">
            <h1 class="ris-table-list__headline ris-headline">Personen</h1>
            <div class="ris-filter-wrapper">
                <ui-search v-model="inputValue" :full-width-mob="true" debounce="500" @input="searchPeople" />
                <ui-dropdown
                    label="Sortierung"
                    id="table-drop"
                    @change="changeFilterValue"
                    :options="[{label:'Nachname', value:'familyName'}, {label:'Party', value: 'party'}]"
                    :hidden-mob="true"
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
                        <member-item
                            class="ris-table-list-secondary-list__item"
                            v-for="member in item.data"
                            :key="member.id"
                            :member="member"/>
                    </ul>
                </li>
            </transition-group>
            <content-loader v-if="loading" :primary-color="'#dadce0'" :height="80">
                <rect x="40" y="20" rx="4" ry="4" width="150" height="3" />
                <rect x="40" y="35" rx="3" ry="3" width="120" height="2" />
                <circle cx="15" cy="30" r="15" />
            </content-loader>
            <transition-group tag="ul" name="fade" class="ris-table-list-main-list ris-ul" v-if="filtered">
                <member-item
                    class="ris-table-list-secondary-list__item"
                    v-for="member in filteredList"
                    :key="`${member.id}-filtered`"
                    :member="member"/>
            </transition-group>
        </section>
        <letter-navigation
            :pagination="true"
            @click="buttonHandle"
                />
    </div>
</template>
