<script>
import CommitteeInfo from './CommitteeInfo';
import CommitteeMemberList from './CommitteeMemberList';
import CommitteeSessions from './CommitteeSessions';
export default {
    name: 'Committee',
    props: {
        info: {
            type: String,
            default: 'info'
        },
        members: {
            type: Array,
            default: () => []
        },
        meetings: {
            type: Array,
            default: () => []
        }
    },
    components: {
        CommitteeInfo,
        CommitteeMemberList,
        CommitteeSessions
    },
    data() {
        return {
            activeTab: 'mitglieder',
            tabs: ['aufgaben', 'mitglieder', 'sitzungen']
        };
    },
};
</script>

<template>
    <div class="">
        <nav class="ris-committee-navigation ris-without-padding-mob">
            <ul class="ris-ul ris-committee-navigation__list">
                <li class="ris-committee-navigation__item" v-for="tab in tabs" :key="tab">
                    <button
                        @click="activeTab = tab"
                        class="ris-committee-navigation__button"
                        :class="[`ris-committee-navigation__button`, activeTab === tab ? 'active' : '' ]">
                        <span v-if="tab === 'sitzungen'" class="ris-i ris-i_calendar-empty" />
                        <span v-if="tab === 'aufgaben'" class="ris-i ris-i_doc" />
                        <span v-if="tab === 'mitglieder'" class="ris-i ris-i_people" />
                        {{ tab }}
                        <span v-if="tab === 'mitglieder'" class="ris-committee-navigation__counter">({{ members.length }})</span>
                    </button>
                </li>
            </ul>
        </nav>
        <CommitteeInfo :information="info" v-if="activeTab === 'aufgaben'" />
        <CommitteeMemberList :members="members" v-if="activeTab === 'mitglieder'" />
        <CommitteeSessions v-if="activeTab === 'sitzungen'" />
    </div>
</template>
