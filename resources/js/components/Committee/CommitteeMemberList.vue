<script>
import Sorting from '../Ux/Sorting';
import CommitteeMember from './CommitteeMember';
import sortingMixin from '../../mixins/sortingMixin';

export default {
    name: 'CommitteeMemberList',
    mixins: [sortingMixin],
    components: {
        Sorting,
        CommitteeMember
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
            dropValue: 'function',
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
            filtered: false,
            filterValue: 'name'
        };
    },
    methods: {
        changeArg(value) {
            this.dropValue = value;
            this.sortBy(this.unfilteredList, value);
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
        <Sorting class="ris-committee-members__sorting ris-without-padding-mob"
            :input-hidden-mob="true"
            drop-label="Sortierung"
            @input="filterList"
            @change="changeArg"
            drop-id="committee-drop"
            :drop-options="dropOptions" />
        <transition-group tag="ul" name="fade" class="ris-ul ris-committee-members-main-list" v-if="!filtered">
            <li v-for="(item, index) in sortedList" :key="`${index}-sortedlist`" class="ris-committee-members-main-list__item">
                <h2 class="ris-committee-members__heading ris-h2" >
                    {{ getTitleValue(item.title) }}
                </h2>
                <ul class="ris-ul ris-committee-members-secondary-list">
                    <CommitteeMember
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
            <CommitteeMember
                v-for="member in filteredList"
                :key="member.name"
                :member="member"
                :is-party="true"
                class="ris-committee-members-secondary-list__item"
                    />
        </transition-group>
    </div>
</template>
