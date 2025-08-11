<template>
    <div class="dashboard">
        <sidebar @toggle-section="toggleSection"></sidebar>
        
        <div class="main-content">
            <general v-if="showGeneral"></general>
            <statistics v-if="showStatistics"></statistics>
            <waiting-list v-if="showWaitingList"></waiting-list>
            <admins v-if="showAdmins"></admins>
            <profile-settings v-if="showProfileSettings"></profile-settings>
        </div>
    </div>
</template>

<script>
import General from './General.vue';
import Statistics from './Statistics.vue';
import WaitingList from './WaitingList.vue';
import Admins from './Admins.vue';
import ProfileSettings from './ProfileSettings.vue';

export default {
    components: {
        General,
        Statistics,
        WaitingList,
        Admins,
        ProfileSettings
    },
    data() {
        return {
            showGeneral: true,
            showStatistics: false,
            showWaitingList: false,
            showAdmins: false,
            showProfileSettings: false,
        };
    },
    methods: {
        toggleSection(section) {
            this.showGeneral = section === 'general';
            this.showStatistics = section === 'statistics';
            this.showWaitingList = section === 'waitingList';
            this.showAdmins = section === 'admins';
            this.showProfileSettings = section === 'profileSettings';
        },
    },
};
</script>

<style scoped>
.dashboard {
    display: flex;
    position: relative;
    width: 1280px;
    height: 800px;
    background: #FFFFFF;
    overflow: hidden;
}

.main-content {
    margin-left: 240px;
    padding: 20px;
    width: calc(100% - 240px);
    height: 100%;
}
</style>