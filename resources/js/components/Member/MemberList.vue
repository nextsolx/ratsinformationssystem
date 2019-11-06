<script>
import sortingMixin from '../../mixins/sortingMixin';

export default {
    name: 'MemberList',
    mixins: [sortingMixin],
    components: {
        MemberItem: () => import('./MemberItem'),
        UiSearch: () => import('../Ui/UiSearch'),
        UiDropdown: () => import('../Ui/UiDropdown'),
    },
    props: {
        members: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            unfilteredList: this.members,
            dropValue: {
                value: 'party',
                label: 'Partei',
            },
            dropOptions: [
                {
                    value: 'role',
                    label: 'Rolle',
                },
                {
                    value: 'party',
                    label: 'Partei',
                }],
            filteredList: [],
            inputValue: '',
            filtered: false,
            filterValue: 'name',
        };
    },
    methods: {
        changeArg(obj) {
            this.inputValue = '';
            this.dropValue = obj;
            this.sortBy(this.unfilteredList, obj.value);
            this.filtered = false;
        },
        getTitleValue(value) {
            if (!value && this.dropValue.value === 'party') return 'Fraktionslose Mitglieder';
            if (!value && this.dropValue.value === 'role') return 'Teilnehmen';
            return value;
        },
    },
    created() {
        this.sortBy(this.unfilteredList, this.dropValue.value);
    },
};
</script>

<template>
    <div class="ris-members">
        <div class="ris-filter-wrapper">
            <ui-search v-model="inputValue" :hidden-mob="true" @input="filterList" />
            <ui-dropdown
                label="Sortierung"
                id="committee-drop"
                :options="dropOptions"
                @change="changeArg"
                :full-width-mob="true"
                v-model="dropValue" />
        </div>
        <transition-group tag="ul" name="fade" class="ris-ul ris-members-main-list" v-if="!filtered">
            <li v-for="(item, index) in sortedList" :key="`${index}-sortedlist`" class="ris-members-main-list__item">
                <h2 class="ris-members__heading ris-h2" >
                    {{ getTitleValue(item.title) }}
                </h2>
                <ul class="ris-ul ris-members-secondary-list">
                    <member-item
                        v-for="member in item.data"
                        :key="member.id"
                        :member="member"
                        class="ris-members-secondary-list__item"
                            />
                </ul>
            </li>
        </transition-group>
        <transition-group tag="ul" name="fade" class="ris-ul ris-members-secondary-list" v-if="filtered">
            <member-item
                v-for="member in filteredList"
                :key="`${member.id}-filtered`"
                :member="member"
                class="ris-members-secondary-list__item"
                    />
        </transition-group>
    </div>
</template>
