<script>
import ThemeItem from './Theme/ThemeItem';
export default {
    name: 'GlobalSearch',
    components: {
        ThemeItem
    },
    data () {
        return {
            onFocus: false,
            inputPlaceholder: 'Suche nach Themen, Vorlagen, Sitzungen...',
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
            inputValue: 'q',
            navigationList: ['Alle', 'Themen', 'Orte', 'Personen'],
            activeTab: 'Alle',
            option: {
                id: 12313123123,
                name: 'Theme title',
                reference: 'qwe123 2',
                type: null,
                date: '2018-11-01 00:00:00'
            }
        };
    },
    methods: {
        focusHandle (value) {
            this.onFocus = value;
            if (value) {
                this.$refs.globalSearchInput.focus();
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
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
                @input="$event => $emit('input', $event.target.value)"
                :placeholder="inputPlaceholder">
        </div>
        <div v-if="onFocus" class="ris-global-search-wrapper">
            <div v-if="!inputValue" class="ris-global-search-autocomplete">
                <h2 class="ris-global-search-autocomplete__title">Aktuell beliebte Suchbegriffe</h2>
                <ul class="ris-global-search-autocomplete__list">
                    <li
                        v-for="item in optionsList"
                        :key="item"
                        class="ris-global-search-autocomplete__item">
                        <button
                            class="ris-global-search-autocomplete__button"
                            @click="inputValue = item">
                            {{ item }}
                        </button>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="ris-global-search__result-title">
                    {{ `xyz Suchergebnisse für „${inputValue}“` }}
                </h3>
                <ul class="ris-ul ris-global-search-navigation">
                    <li
                        class="ris-global-search-navigation__item"
                        v-for="item in navigationList"
                        :key="item">
                        <button
                            class="ris-global-search-navigation__button"
                            :class="{ isActive : item === activeTab }"
                            @click="activeTab = item">
                            {{ item }}
                        </button>
                    </li>
                </ul>
                <ul class="ris-ul ris-global-search-content">
                    <li v-if="activeTab === 'Alle' || activeTab === 'Themen'" class="ris-global-search-content__item">
                        <h2 class="ris-global-search-content__title">Themen</h2>
                        <ul class="ris-ul ris-global-search-content__list">
                            <li class="ris-global-search-content__item">
                                <ThemeItem :options="option" />
                            </li>
                        </ul>
                        <button class="ris-global-search-content__button ris-link ris-link_button ris-link_right">
                            Alle 217 Themen laden
                            <span class="ris-i ris-i_chevron-right" />
                        </button>
                    </li>
                    <li v-if="activeTab === 'Alle' || activeTab === 'Orte'" class="ris-global-search-content__item">
                        <h2 class="ris-global-search-content__title">Orte</h2>
                        <ul class="ris-ul ris-global-search-content-theme">
                            <li class="ris-global-search-content-theme__item">
                                qwe
                            </li>
                        </ul>
                        <button class="ris-global-search-content__button ris-link ris-link_button ris-link_right">
                            Alle 217 Themen laden
                            <span class="ris-i ris-i_chevron-right" />
                        </button>
                    </li>
                    <li v-if="activeTab === 'Alle' || activeTab === 'Personen'" class="ris-global-search-content__item">
                        <h2 class="ris-global-search-content__title">Personen</h2>
                        <ul class="ris-ul ris-global-search-content-theme">
                            <li class="ris-global-search-content-theme__item">
                                qwe
                            </li>
                        </ul>
                        <button class="ris-global-search-content__button ris-link ris-link_button ris-link_right">
                            Alle 217 Themen laden
                            <span class="ris-i ris-i_chevron-right" />
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div
            v-if="onFocus"
            @click="focusHandle(false)"
            class="ris-global-search__background"/>
    </div>
</template>
