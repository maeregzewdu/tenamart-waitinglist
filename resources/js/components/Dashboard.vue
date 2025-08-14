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
        <div class="menu-item danger" @click="showLogoutConfirmation">
          <i class="ri-logout-box-r-line"></i>
          <span>Log out</span>
        </div>
        <div class="menu-item danger" @click="showDeleteConfirmation">
          <i class="ri-delete-bin-line"></i>
          <span>Delete account</span>
        </div>
      </div>
    </div>

    <!-- Custom Modal -->
    <div v-if="showModal" class="modal-overlay">
      <div class="modal">
        <div class="modal-header">
          <h3>{{ modalTitle }}</h3>
          <i class="ri-close-line" @click="closeModal"></i>
        </div>
        <div class="modal-body">
          <p>{{ modalMessage }}</p>
        </div>
        <div class="modal-footer">
          <button class="btn-cancel" @click="closeModal">Cancel</button>
          <button 
            class="btn-confirm" 
            :class="{ 'danger': isDangerAction }"
            @click="confirmAction"
          >
            {{ confirmButtonText }}
          </button>
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
import axios from 'axios'

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
        name: '',
        email: ''
      },
      showModal: false,
      modalTitle: '',
      modalMessage: '',
      confirmButtonText: 'Confirm',
      isDangerAction: false,
      pendingAction: null
    }
  },
  computed: {
    userInitial() {
      return this.user.name ? this.user.name.charAt(0).toUpperCase() : ''
    },
    userName() {
      return this.user.name || 'Loading...'
    },
    userEmail() {
      return this.user.email || 'Loading...'
    }
  },
  mounted() {
    this.fetchCurrentUser()
  },
  methods: {
    async fetchCurrentUser() {
      try {
        const response = await axios.get('/current-user')
        this.user = {
          name: response.data.name,
          email: response.data.email
        }
      } catch (error) {
        console.error('Error fetching user:', error)
        if (error.response && error.response.status === 401) {
          window.location.href = '/login'
        }
      }
    },
    setActiveSection(section) {
      this.activeSection = section
      this.userMenuOpen = false
    },
    toggleUserMenu() {
      this.userMenuOpen = !this.userMenuOpen
    },
    showLogoutConfirmation() {
      this.modalTitle = 'Confirm Logout'
      this.modalMessage = 'Are you sure you want to log out?'
      this.confirmButtonText = 'Log out'
      this.isDangerAction = false
      this.pendingAction = this.performLogout
      this.showModal = true
      this.userMenuOpen = false
    },
    showDeleteConfirmation() {
      this.modalTitle = 'Delete Account'
      this.modalMessage = 'WARNING: This will permanently delete your account and all associated data. This action cannot be undone.'
      this.confirmButtonText = 'Delete'
      this.isDangerAction = true
      this.pendingAction = this.performDeleteAccount
      this.showModal = true
      this.userMenuOpen = false
    },
    showError(message) {
      this.modalTitle = 'Error'
      this.modalMessage = message
      this.confirmButtonText = 'OK'
      this.isDangerAction = true
      this.pendingAction = null
      this.showModal = true
    },
    closeModal() {
      this.showModal = false
      this.pendingAction = null
    },
    confirmAction() {
      if (this.pendingAction) {
        this.pendingAction()
      } else {
        this.closeModal()
      }
    },
    async performLogout() {
      try {
        await axios.post('/logout')
        window.location.href = '/login'
      } catch (error) {
        console.error('Logout failed:', error)
        this.showError('Logout failed. Please try again.')
      }
    },
    async performDeleteAccount() {
      try {
        await axios.delete('/delete-account')
        window.location.href = '/login'
      } catch (error) {
        console.error('Account deletion failed:', error)
        this.showError('Account deletion failed. Please try again.')
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
  left: 10px;
  width: 220px;
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
  margin-right: 12px;
}

.profile-details {
  flex-grow: 1;
  min-width: 0;
}

.username {
  font-weight: 500;
  font-size: 14px;
  color: #000000;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.email {
  font-weight: 500;
  font-size: 12px;
  color: #000000;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.toggle-menu {
  display: flex;
  flex-direction: column;
  margin-left: 8px;
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

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  animation: fadeIn 0.3s ease-out forwards;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.modal {
  background: white;
  border-radius: 8px;
  width: 400px;
  max-width: 90%;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
  overflow: hidden;
  animation: slideUp 0.3s ease-out forwards;
}

@keyframes slideUp {
  from { transform: translateY(20px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px 20px;
  border-bottom: 1px solid #E5E5E5;
}

.modal-header h3 {
  margin: 0;
  font-size: 18px;
  font-weight: 600;
  color: #333;
}

.modal-header i {
  font-size: 20px;
  color: #777;
  cursor: pointer;
  transition: color 0.2s;
}

.modal-header i:hover {
  color: #333;
}

.modal-body {
  padding: 20px;
}

.modal-body p {
  margin: 0;
  color: #555;
  line-height: 1.5;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  padding: 16px 20px;
  border-top: 1px solid #E5E5E5;
  gap: 10px;
}

.btn-cancel, .btn-confirm {
  padding: 8px 16px;
  border-radius: 4px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-cancel {
  background: #F0F0F0;
  color: #333;
  border: none;
}

.btn-cancel:hover {
  background: #E5E5E5;
}

.btn-confirm {
  background: #10B982;
  color: white;
  border: none;
}

.btn-confirm.danger {
  background: #EF4444;
}

.btn-confirm:hover {
  opacity: 0.9;
}
</style>