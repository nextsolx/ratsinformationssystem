<script>
import ThemeWidget from './Theme/ThemeWidget';
import PersonWidget from './PersonWidget';
import MapWidget from './Map/MapWidget';
import { ContentLoader } from 'vue-content-loader';
import location from '../api/location';
import people from '../api/people';
import topics from '../api/topics';
import intersectionObserverMixin from '../mixins/intersectionObserverMixin';
export default {
    name: 'GlobalSearch',
    mixins: [
        intersectionObserverMixin
    ],
    components: {
        ThemeWidget,
        PersonWidget,
        MapWidget,
        ContentLoader
    },
    data () {
        return {
            onFocus: false,
            loading: false,
            observableBlock: '.ris-load-element',
            optionsList: [
                'Bewohnerparken',
                'Radwege',
                'Brückensanierung',
                'Umweltzone',
                'Öffentliche Parkplätze',
                'Schulen',
                'Klimanotstand',
                'eRoller'
            ],
            inputValue: '',
            activeTab: 'Alle',
            topicsList: [],
            topicsTotalCount: 0,
            paginationTopics: 0,
            topicsFlag: true,
            peopleList: [],
            peopleTotalCount: 0,
            paginationPeople: 0,
            peopleFlag: true,
            locationList: [],
            locationTotalCount: 0,
            paginationLocation: 0,
            locationFlag: true,
            debounce: null
        };
    },
    computed: {
        navigationList () {
            const list = [];
            if (this.topicsList.length) list.push('Themen');
            if (this.locationList.length) list.push('Orte');
            if (this.peopleList.length) list.push('Personen');
            return ['Alle', ...list];
        },
        isEmptySearchResults () {
            return this.inputValue &&
                !this.loading &&
                !this.topicsList.length &&
                !this.locationList.length &&
                !this.peopleList.length;
        },
        totalCount () {
            return this.topicsTotalCount + this.peopleTotalCount + this.locationTotalCount;
        }
    },
    methods: {
        debounceCheck () {
            this.debounce && clearTimeout(this.debounce);
        },
        focusHandle (value) {
            this.onFocus = value;
            if (value) {
                this.$refs.globalSearchInput.focus();
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        },
        async getTopics () {
            if (!this.topicsFlag) return;
            this.paginationTopics += 1;
            const { data, meta } = await topics.getTopicsLike(this.inputValue, this.paginationTopics);
            if (data && meta) {
                this.topicsTotalCount = meta.total;
                this.topicsList = [...this.topicsList, ...data];
                this.loading = false;
                if (!data.length) this.topicsFlag = false;
            }

        },
        async getPeople () {
            if (!this.peopleFlag) return;
            this.paginationPeople += 1;
            const { members, meta } = await people.getPeopleLike(this.inputValue, this.paginationPeople);
            if (members && meta) {
                this.peopleTotalCount = meta.total;
                this.peopleList = [...this.peopleList, ...members];
                this.loading = false;
                if (!members.length) this.peopleFlag = false;
            }
        },
        async getLocations () {
            if (!this.locationFlag) return;
            this.paginationLocation += 1;
            const { locations, meta } = await location.getLocationLike(this.inputValue, this.paginationLocation);
            if (locations && meta) {
                this.locationTotalCount = meta.total;
                this.locationList = [...this.locationList, ...locations];
                this.loading = false;
                if (!locations.length) this.locationFlag = false;
            }
        },
        lazyHandle () {
            this.debounceCheck();
            this.debounce = setTimeout(
                () => {
                    if (this.activeTab === 'Themen') this.getTopics();
                    if (this.activeTab === 'Orte') this.getLocations();
                    if (this.activeTab === 'Personen') this.getPeople();
                }, 500);
        },
        changeTab (item) {
            this.activeTab = item;
            setTimeout(() => this.createObserver(), 0);// need time to render DOM after switching tab
        },
        inputHandle () {
            this.topicsFlag = true;
            this.locationFlag = true;
            this.peopleFlag = true;
            this.topicsList = [];
            this.locationList = [];
            this.peopleList = [];
            this.locationTotalCount = 0;
            this.peopleTotalCount = 0;
            this.topicsTotalCount = 0;
            this.debounceCheck();
            if (this.inputValue) {
                this.loading = true;
                this.debounce = setTimeout(
                    () => {
                        this.getTopics();
                        this.getLocations();
                        this.getPeople();
                    }, 1000);
            }
        }
    }
};
</script>

<template>
    <div class="ris-global-search">
        <div
            class="ris-search ris-global-search-input"
            :class="{ 'focused': onFocus }">
            <button @click="onFocus ? focusHandle(false) : focusHandle(true)" class="ris-search__button">
                <span v-if="onFocus" class="ris-i ris-i_back" />
                <span v-else class="ris-i ris-i_search"/>
            </button>
            <input
                type="search"
                class="ris-search__input ris-global-search-input__item"
                :class="{ 'focused': onFocus }"
                v-model="inputValue"
                ref="globalSearchInput"
                @focus="focusHandle(true)"
                @input="inputHandle"
                placeholder="Suche nach Themen, Vorlagen, Sitzungen...">
        </div>
        <div v-if="onFocus && inputValue" class="ris-global-search-wrapper">
            <!--            <div v-if="!inputValue" class="ris-global-search-autocomplete">-->
            <!--                <h2 class="ris-global-search-autocomplete__title">Aktuell beliebte Suchbegriffe</h2>-->
            <!--                <ul class="ris-global-search-autocomplete__list">-->
            <!--                    <li-->
            <!--                        v-for="item in optionsList"-->
            <!--                        :key="item"-->
            <!--                        class="ris-global-search-autocomplete__item">-->
            <!--                        <button-->
            <!--                            class="ris-global-search-autocomplete__button"-->
            <!--                            @click="inputValue = item">-->
            <!--                            {{ item }}-->
            <!--                        </button>-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!--            </div>-->
            <div>
                <h3 v-if="!isEmptySearchResults" class="ris-global-search__result-title">
                    {{ `${totalCount} Suchergebnisse für „${inputValue}“` }}
                </h3>
                <ul v-if="!isEmptySearchResults" class="ris-ul ris-global-search-navigation">
                    <li
                        class="ris-global-search-navigation__item"
                        v-for="item in navigationList"
                        :key="item">
                        <button
                            class="ris-global-search-navigation__button"
                            :class="{ isActive : item === activeTab }"
                            @click="changeTab(item)">
                            {{ item }}
                        </button>
                    </li>
                </ul>
                <ul v-if="!isEmptySearchResults" class="ris-ul ris-global-search-content">
                    <li
                        v-if="(activeTab === 'Alle' || activeTab === 'Themen') && topicsList.length"
                        class="ris-global-search-content__item">
                        <h2 class="ris-global-search-content__title">Themen</h2>
                        <ul class="ris-ul ris-global-search-content__list ris-global-search-content__theme">
                            <li
                                class="ris-global-search-content__item"
                                v-for="(topic, index) in topicsList"
                                v-show="(index < 3) || activeTab === 'Themen'"
                                :key="topic.id">
                                <ThemeWidget :filter-value="inputValue" :topic="topic" />
                            </li>
                            <li v-if="activeTab === 'Themen'" class="ris-load-element" />
                        </ul>
                        <button
                            class="ris-global-search-content__button ris-link ris-link_button ris-link_right"
                            v-if="activeTab === 'Alle' && topicsList.length > 3"
                            @click="activeTab = 'Themen'">
                            {{ `Alle ${topicsTotalCount} Themen laden` }}
                            <span class="ris-i ris-i_chevron-right" />
                        </button>
                    </li>
                    <li
                        v-if="(activeTab === 'Alle' || activeTab === 'Orte') && locationList.length"
                        class="ris-global-search-content__item">
                        <h2 class="ris-global-search-content__title">Orte</h2>
                        <ul class="ris-ul ris-global-search-content__list ris-global-search-content__map">
                            <li
                                class="ris-global-search-content__item"
                                v-for="(location, index) in locationList"
                                v-show="(index < 4) || activeTab === 'Orte'"
                                :key="location.id">
                                <MapWidget :filter-value="inputValue" :options="location" />
                            </li>
                            <li v-if="activeTab === 'Orte'" class="ris-load-element" />
                        </ul>
                        <button
                            class="ris-global-search-content__button ris-link ris-link_button ris-link_right"
                            v-if="activeTab === 'Alle' && locationList.length > 3"
                            @click="activeTab = 'Orte'">
                            {{ `Alle ${locationTotalCount} Orte laden` }}
                            <span class="ris-i ris-i_chevron-right" />
                        </button>
                    </li>
                    <li
                        v-if="(activeTab === 'Alle' || activeTab === 'Personen') && peopleList.length"
                        class="ris-global-search-content__item">
                        <h2 class="ris-global-search-content__title">Personen</h2>
                        <ul class="ris-ul ris-global-search-content__list ris-global-search-content__person">
                            <li
                                class="ris-global-search-content__item"
                                v-for="(person, index) in peopleList"
                                v-show="(index < 5) || activeTab === 'Personen'"
                                :key="person.id">
                                <PersonWidget :filter-value="inputValue" :person="person" />
                            </li>
                            <li v-if="activeTab === 'Personen'" class="ris-load-element" />
                        </ul>
                        <button
                            class="ris-global-search-content__button ris-link ris-link_button ris-link_right"
                            v-if="activeTab === 'Alle' && peopleList.length > 5"
                            @click="activeTab = 'Personen'">
                            {{ `Alle ${peopleTotalCount} Personen laden` }}
                            <span class="ris-i ris-i_chevron-right" />
                        </button>
                    </li>
                </ul>
                <content-loader v-if="inputValue && loading" :primary-color="'#dadce0'" style="padding-left: 20px" :height="80">
                    <rect x="40" y="20" rx="4" ry="4" width="150" height="4" />
                    <rect x="40" y="35" rx="4" ry="4" width="120" height="3" />
                    <circle cx="15" cy="30" r="15" />
                </content-loader>
                <div v-if="isEmptySearchResults" class="ris-global-search-placeholder">
                    <h2 class="ris-h2 ris-global-search-placeholder__title">{{ `Für „${inputValue}“ wurde leider nichts gefunden` }}</h2>
                    <p class="ris-global-search-placeholder__info">Versuchen Sie es doch mit einem anderen Suchbegriff.</p>
                </div>
            </div>
        </div>
        <div
            v-if="onFocus"
            @click="focusHandle(false)"
            class="ris-global-search__background"/>
    </div>
</template>
