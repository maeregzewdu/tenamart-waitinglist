<template>
  <div class="dashboard">
    <sidebar 
      :active-section="activeSection" 
      @toggle-section="setActiveSection"
    ></sidebar>
    
    <div class="main-content">
      <general v-if="activeSection === 'general'"></general>
      <statistics v-if="activeSection === 'statistics'"></statistics>
      <waiting-list v-if="activeSection === 'waitingList'"></waiting-list>
      <admins v-if="activeSection === 'admins'"></admins>
      <profile-settings v-if="activeSection === 'profileSettings'"></profile-settings>
    </div>

    <!-- User Profile Section -->
    <div class="user-profile">
      <div class="profile-info" @click="toggleUserMenu">
        <div class="profile-initials">{{ userInitial }}</div>
        <div class="profile-details">
          <div class="username">{{ userName }}</div>
          <div class="email">{{ userEmail }}</div>
        </div>
        <div class="toggle-menu">
          <i class="ri-arrow-up-s-line" v-if="userMenuOpen"></i>
          <i class="ri-arrow-down-s-line" v-else></i>
        </div>
      </div>
      <div v-if="userMenuOpen" class="user-menu">
        <div class="menu-item" @click="setActiveSection('profileSettings')">
          <i class="ri-settings-3-line"></i>
          <span>Profile Settings</span>
        </div>
        <div class="menu-divider"></div>
        <div class="menu-item danger" @click="confirmLogout">
          <i class="ri-logout-box-r-line"></i>
          <span>Log out</span>
        </div>
        <div class="menu-item danger" @click="confirmDeleteAccount">
          <i class="ri-delete-bin-line"></i>
          <span>Delete account</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Sidebar from './Sidebar.vue'
import General from './General.vue'
import Statistics from './Statistics.vue'
import WaitingList from './WaitingList.vue'
import Admins from './Admins.vue'
import ProfileSettings from './ProfileSettings.vue'

export default {
  components: {
    Sidebar,
    General,
    Statistics,
    WaitingList,
    Admins,
    ProfileSettings
  },
  data() {
    return {
      activeSection: 'general',
      userMenuOpen: false,
      user: {
        name: 'Saron Yirga',
        email: 'saronyirga@g...'
      }
    }
  },
  computed: {
    userInitial() {
      return this.user.name ? this.user.name.charAt(0).toUpperCase() : ''
    },
    userName() {
      return this.user.name || 'User Name'
    },
    userEmail() {
      return this.user.email || 'user@example.com'
    }
  },
  methods: {
    setActiveSection(section) {
      this.activeSection = section
      this.userMenuOpen = false
    },
    toggleUserMenu() {
      this.userMenuOpen = !this.userMenuOpen
    },
    confirmLogout() {
      if (confirm('Are you sure you want to log out?')) {
        this.$emit('logout')
      }
    },
    confirmDeleteAccount() {
      if (confirm('WARNING: This will permanently delete your account. Are you sure?')) {
        this.$emit('delete-account')
      }
    }
  }
}
</script>

<style scoped>
.dashboard {
  display: flex;
  position: relative;
  width: 1280px;
  height: 800px;
  background: #FFFFFF;
  overflow: hidden;
  font-family: 'Raleway', sans-serif;
}

.main-content {
  margin-left: 240px;
  padding: 20px;
  width: calc(100% - 240px);
  height: 100%;
}

.user-profile {
  position: absolute;
  bottom: 20px;
  left: 20px;
  width: 200px;
  z-index: 100;
}

.profile-info {
  display: flex;
  align-items: center;
  background: #F0F0F0;
  border-radius: 5px;
  padding: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.profile-info:hover {
  background: #E5E5E5;
}

.profile-initials {
  width: 40px;
  height: 40px;
  background: #10B982;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: bold;
  font-size: 16px;
  margin-right: 10px;
}

.profile-details {
  flex-grow: 1;
}

.username {
  font-weight: 500;
  font-size: 14px;
  color: #000000;
}

.email {
  font-weight: 500;
  font-size: 12px;
  color: #000000;
}

.toggle-menu {
  display: flex;
  flex-direction: column;
}

.toggle-menu i {
  color: #505050;
  font-size: 20px;
  transition: transform 0.3s ease;
}

.user-menu {
  position: absolute;
  bottom: 80px;
  left: 0;
  width: 100%;
  background: #FFFFFF;
  border-radius: 5px;
  box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  transform-origin: bottom;
  animation: scaleIn 0.2s ease-out forwards;
}

@keyframes scaleIn {
  from {
    transform: scaleY(0);
    opacity: 0;
  }
  to {
    transform: scaleY(1);
    opacity: 1;
  }
}

.menu-item {
  padding: 12px 16px;
  display: flex;
  align-items: center;
  font-size: 14px;
  color: #000000;
  transition: all 0.2s;
  cursor: pointer;
}

.menu-item:hover {
  background: #F0F0F0;
}

.menu-item i {
  margin-right: 10px;
  font-size: 16px;
}

.menu-item.danger {
  color: #EF4444;
}

.menu-item.danger i {
  color: #EF4444;
}

.menu-divider {
  height: 1px;
  background: #E5E5E5;
  margin: 4px 0;
}
</style>