<script>
import CommitteeInfo from './CommitteeInfo';
import CommitteeMemberList from './CommitteeMemberList';
import CommitteeSessions from './CommitteeSessions';
export default {
    name: 'Committee',
    props: {
        info: {
            type: String,
            default: () => 'info'
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
            activeTab: 'mitglieder'
        };
    },
};
</script>

<template>
    <div class="">
        <nav class="ris-committee-navigation ris-without-padding-mob">
            <ul class="ris-ul ris-committee-navigation__list">
                <li class="ris-committee-navigation__item">
                    <button
                        @click="activeTab = 'aufgaben'"
                        :class="['ris-committee-navigation__button ris-committee-navigation__button--aufgaben', activeTab === 'aufgaben' ? 'active' : '' ]">
                        Aufgaben
                    </button>
                </li>
                <li class="ris-committee-navigation__item">
                    <button
                        @click="activeTab = 'mitglieder'"
                        :class="['ris-committee-navigation__button ris-committee-navigation__button--mitglieder', activeTab === 'mitglieder' ? 'active' : '' ]">
                        Mitglieder <span class="ris-committee-navigation__counter">({{ members.length }})</span>
                    </button>
                </li>
                <li class="ris-committee-navigation__item">
                    <button
                        @click="activeTab = 'sitzungen'"
                        :class="['ris-committee-navigation__button ris-committee-navigation__button--sitzungen', activeTab === 'sitzungen' ? 'active' : '' ]">
                        Sitzungen
                    </button>
                </li>
            </ul>
        </nav>
        <CommitteeInfo :information="info" v-if="activeTab === 'aufgaben'" />
        <CommitteeMemberList :members="members" v-if="activeTab === 'mitglieder'" />
        <CommitteeSessions v-if="activeTab === 'sitzungen'" />
    </div>
</template>
