<script>
import Member from '../Member';
import sortingMixin from '../../mixins/sortingMixin';

export default {
    name: 'CommitteeMemberList',
    mixins: [sortingMixin],
    components: {
        Member
    },
    props: {
        members: {
            type: Array,
            default: () => []
        }
    },
    created() {
        this.sortBy(this.unfilteredList,'function');
    },
    data() {
        return {
            unfilteredList: this.members,
            dropValue: {
                value: 'function',
                label: 'Funktion'
            },
            dropOptions: [
                {
                    value: 'function',
                    label: 'Funktion'
                },
                {
                    value: 'party',
                    label: 'Partei'
                }],
            filteredList: [],
            inputValue: '',
            filtered: false,
            filterValue: 'name'
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
            if (!value && this.dropValue === 'party') return 'Fraktionslose Mitglieder';
            return value;
        },
    },
};
</script>

<template>
    <div class="ris-committee-members">
        <div class="ris-filter-wrapper">
            <Search v-model="inputValue" :hidden-mob="true" @input="filterList" />
            <Dropdown
                label="Sortierung"
                id="committee-drop"
                :options="dropOptions"
                @change="changeArg"
                :full-width-mob="true"
                v-model="dropValue" />
        </div>
        <transition-group tag="ul" name="fade" class="ris-ul ris-committee-members-main-list" v-if="!filtered">
            <li v-for="(item, index) in sortedList" :key="`${index}-sortedlist`" class="ris-committee-members-main-list__item">
                <h2 class="ris-committee-members__heading ris-h2" >
                    {{ getTitleValue(item.title) }}
                </h2>
                <ul class="ris-ul ris-committee-members-secondary-list">
                    <Member
                        v-for="member in item.data"
                        :key="member.name"
                        :member="member"
                        :is-party="true"
                        class="ris-committee-members-secondary-list__item"
                            />
                </ul>
            </li>
        </transition-group>
        <transition-group tag="ul" name="fade" class="ris-ul ris-committee-members-secondary-list" v-if="filtered">
            <Member
                v-for="member in filteredList"
                :key="member.name"
                :member="member"
                :is-party="true"
                class="ris-committee-members-secondary-list__item"
                    />
        </transition-group>
    </div>
</template>
