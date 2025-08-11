<template>
    <aside class="sidebar">
        <!-- Logo Section -->
        <div class="logo-section">
            <img src="../public/logo-teal.png" alt="Logo" class="logo">
        </div>

        <!-- Main Navigation -->
        <nav class="main-nav">
            <ul>
                <sidebar-item icon="ri-dashboard-line" title="General" :active="activeSection === 'general'" @click="toggleSection('general')"></sidebar-item>
                <sidebar-item icon="ri-bar-chart-line" title="Statistics" :active="activeSection === 'statistics'" @click="toggleSection('statistics')"></sidebar-item>
                <sidebar-item icon="ri-list-check" title="Waiting list" :active="activeSection === 'waitingList'" @click="toggleSection('waitingList')"></sidebar-item>
                <sidebar-item icon="ri-user-settings-line" title="Admins" :active="activeSection === 'admins'" @click="toggleSection('admins')"></sidebar-item>
                <sidebar-item icon="ri-settings-3-line" title="Profile Settings" :active="activeSection === 'profileSettings'" @click="toggleSection('profileSettings')"></sidebar-item>
            </ul>
        </nav>

        <!-- User Profile Section -->
        <div class="user-profile" @click="toggleProfileMenu">
            <div class="avatar">{{ userInitial }}</div>
            <div class="user-info">
                <div class="username">{{ userName }}</div>
                <div class="email">{{ userEmail }}</div>
            </div>
            <div class="profile-toggle">
                <i class="ri-arrow-up-s-line" v-if="showProfileMenu"></i>
                <i class="ri-arrow-down-s-line" v-else></i>
            </div>
            
            <!-- Profile Dropdown Menu -->
            <div class="profile-menu" v-if="showProfileMenu">
                <div class="menu-item" @click="toggleSection('profileSettings')">
                    <i class="ri-settings-3-line"></i>
                    <span>Profile Settings</span>
                </div>
                <div class="menu-item" @click="handleLogout">
                    <i class="ri-logout-box-r-line"></i>
                    <span>Log out</span>
                </div>
                <div class="menu-item" @click="handleDeleteAccount">
                    <i class="ri-delete-bin-line"></i>
                    <span>Delete account</span>
                </div>
            </div>
        </div>
    </aside>
</template>

<script>
import SidebarItem from './SidebarItem.vue';

export default {
    components: {
        SidebarItem,
    },
    props: {
        activeSection: {
            type: String,
            default: 'general'
        },
        userName: {
            type: String,
            default: 'Saron Yirga'
        },
        userEmail: {
            type: String,
            default: 'saronyirga@g...'
        }
    },
    data() {
        return {
            showProfileMenu: false
        };
    },
    computed: {
        userInitial() {
            return this.userName.charAt(0).toUpperCase();
        }
    },
    methods: {
        toggleSection(section) {
            this.$emit('toggle-section', section);
            this.showProfileMenu = false;
        },
        toggleProfileMenu() {
            this.showProfileMenu = !this.showProfileMenu;
        },
        handleLogout() {
            this.$emit('logout');
        },
        handleDeleteAccount() {
            this.$emit('delete-account');
        }
    },
};
</script>

<style scoped>
.sidebar {
    position: absolute;
    width: 240px;
    height: 800px;
    background: #FFFFFF;
    border-right: 1px solid #E5E5E5;
    display: flex;
    flex-direction: column;
    padding: 20px 0;
}

.logo-section {
    padding: 20px;
    display: flex;
    justify-content: flex-end;
    border-bottom: 1px solid #E5E5E5;
    margin-bottom: 20px;
}

.logo {
    height: 40px;
}

.main-nav {
    padding: 0 10px;
    flex-grow: 1;
}

.user-profile {
    position: relative;
    width: 200px;
    height: 72px;
    background: #F0F0F0;
    border-radius: 5px;
    display: flex;
    align-items: center;
    padding: 16px;
    margin: 0 20px 20px;
    cursor: pointer;
}

.avatar {
    width: 40px;
    height: 40px;
    background: #10B982;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    margin-right: 10px;
    font-family: 'Raleway';
    font-size: 16px;
}

.user-info {
    flex-grow: 1;
}

.username {
    font-family: 'Raleway';
    font-weight: 500;
    font-size: 14px;
    color: #000000;
}

.email {
    font-family: 'Raleway';
    font-weight: 500;
    font-size: 12px;
    color: #000000;
}

.profile-toggle {
    width: 20px;
    height: 20px;
    position: relative;
}

.profile-toggle i {
    position: absolute;
    color: #505050;
    font-size: 20px;
}

.profile-menu {
    position: absolute;
    bottom: 80px;
    left: 0;
    width: 100%;
    background: #FFFFFF;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    z-index: 10;
}

.menu-item {
    padding: 12px 16px;
    display: flex;
    align-items: center;
    font-family: 'Raleway';
    font-size: 14px;
    color: #000000;
    transition: background-color 0.2s;
}

.menu-item:hover {
    background: #F0F0F0;
}

.menu-item i {
    margin-right: 10px;
    font-size: 16px;
    color: #505050;
}
</style>