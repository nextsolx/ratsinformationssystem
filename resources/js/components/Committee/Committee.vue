<script>
import CommitteeInfo from './CommitteeInfo';
import MemberList from '../MemberList';
import CommitteeSessions from './CommitteeSessions';

export default {
    name: 'Committee',
    props: {
        info: {
            type: String,
            default: 'info',
        },
        members: {
            type: Array,
            default: () => [],
        },
        meetings: {
            type: Array,
            default: () => [],
        },
    },
    components: {
        CommitteeInfo,
        MemberList,
        CommitteeSessions,
    },
    data() {
        return {
            activeTab: 'aufgaben',
            tabs: ['aufgaben', 'mitglieder', 'sitzungen'],
        };
    },
    methods: {
        getClassForTab(tab) {
            if (tab === 'sitzungen') return 'ris-i_calendar-empty';
            if (tab === 'aufgaben') return 'ris-i_doc';
            return 'ris-i_people';
        },
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
                        <span class="ris-i" :class="getClassForTab(tab)" />
                        {{ tab }}
                        <span v-if="tab === 'mitglieder'" class="ris-committee-navigation__counter">({{ members.length }})</span>
                    </button>
                </li>
            </ul>
        </nav>
        <CommitteeInfo :information="info" v-if="activeTab === 'aufgaben'" />
        <MemberList :members="members" v-if="activeTab === 'mitglieder'" />
        <CommitteeSessions :meetings="meetings" v-if="activeTab === 'sitzungen'" />
    </div>
</template>
