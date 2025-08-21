<template>
  <div class="settings-page">
    <!-- Profile Settings Section -->
    <div class="settings-section">
      <div class="section-header">
        <div class="icon-container green-bg">
          <i class="ri-user-settings-line"></i>
        </div>
        <h1>General settings</h1>
      </div>
      
      <p class="subtitle">edit your name and email</p>
      <div class="divider"></div>
      
      <div class="settings-content">
        <div class="form-group">
          <label>Name</label>
          <input 
            type="text" 
            class="form-input" 
            v-model="formData.name"
            :placeholder="currentUser.name"
          >
        </div>
        
        <div class="form-group">
          <label>Email</label>
          <input 
            type="email" 
            class="form-input" 
            v-model="formData.email"
            :placeholder="currentUser.email"
          >
        </div>
        
        <button 
          class="action-btn green-btn"
          @click="saveProfile"
          :disabled="isSavingProfile || !hasProfileChanges"
        >
          <i class="ri-save-line"></i>
          <span>{{ isSavingProfile ? 'Saving...' : 'Save changes' }}</span>
        </button>

        <div v-if="profileSuccess" class="success-message">
          <i class="ri-checkbox-circle-fill"></i> Profile updated successfully
        </div>
        <div v-if="profileError" class="error-message">
          <i class="ri-error-warning-fill"></i> {{ profileError }}
        </div>
      </div>
    </div>

    <!-- Password Settings Section -->
    <div class="settings-section">
      <div class="section-header">
        <div class="icon-container green-bg">
          <i class="ri-lock-password-line"></i>
        </div>
        <h2>Password settings</h2>
      </div>
      
      <p class="subtitle">change your password</p>
      <div class="divider"></div>
      
      <div class="settings-content">
        <div class="form-group">
          <label>Current password</label>
          <input 
            type="password" 
            class="form-input" 
            v-model="passwordData.current_password"
            placeholder="Enter your current password"
          >
        </div>
        
        <div class="form-group">
          <label>New password</label>
          <input 
            type="password" 
            class="form-input" 
            v-model="passwordData.new_password"
            placeholder="Enter new password"
          >
          <div class="password-hint" v-if="passwordData.new_password">
            Password strength: {{ passwordStrength }}
          </div>
        </div>
        
        <div class="form-group">
          <label>Confirm new password</label>
          <input 
            type="password" 
            class="form-input" 
            v-model="passwordData.new_password_confirmation"
            placeholder="Confirm your new password"
            @keyup.enter="changePassword"
          >
          <div v-if="passwordMismatch" class="error-message">
            <i class="ri-error-warning-fill"></i> Passwords don't match
          </div>
        </div>
        
        <button 
          class="action-btn green-btn"
          @click="changePassword"
          :disabled="isChangingPassword || !canChangePassword"
        >
          <i class="ri-save-line"></i>
          <span>{{ isChangingPassword ? 'Updating...' : 'Change Password' }}</span>
        </button>

        <div v-if="passwordSuccess" class="success-message">
          <i class="ri-checkbox-circle-fill"></i> Password updated successfully
        </div>
        <div v-if="passwordError" class="error-message">
          <i class="ri-error-warning-fill"></i> {{ passwordError }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ProfileSettings',
  data() {
    return {
      currentUser: {
        name: '',
        email: ''
      },
      formData: {
        name: '',
        email: ''
      },
      passwordData: {
        current_password: '',
        new_password: '',
        new_password_confirmation: ''
      },
      isSavingProfile: false,
      isChangingPassword: false,
      profileSuccess: false,
      profileError: '',
      passwordSuccess: false,
      passwordError: '',
      passwordMismatch: false
    };
  },
  computed: {
    passwordStrength() {
      if (!this.passwordData.new_password) return '';
      const strength = this.calculatePasswordStrength(this.passwordData.new_password);
      if (strength < 3) return 'Weak';
      if (strength < 5) return 'Medium';
      return 'Strong';
    },
    hasProfileChanges() {
      return this.formData.name !== this.currentUser.name || 
             this.formData.email !== this.currentUser.email;
    },
    canChangePassword() {
      return this.passwordData.current_password && 
             this.passwordData.new_password && 
             this.passwordData.new_password_confirmation &&
             !this.passwordMismatch &&
             this.passwordData.new_password.length >= 8;
    }
  },
  watch: {
    'passwordData.new_password'(newVal) {
      if (newVal && this.passwordData.new_password_confirmation) {
        this.passwordMismatch = newVal !== this.passwordData.new_password_confirmation;
      }
    },
    'passwordData.new_password_confirmation'(newVal) {
      if (newVal && this.passwordData.new_password) {
        this.passwordMismatch = newVal !== this.passwordData.new_password;
      }
    }
  },
  created() {
    this.loadCurrentUser();
    this.setCSRFToken();
  },
  methods: {
    setCSRFToken() {
      const token = document.querySelector('meta[name="csrf-token"]');
      if (token) {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
      }
    },
    async loadCurrentUser() {
      try {
        const response = await axios.get('/current-user');
        this.currentUser = {
          name: response.data.name,
          email: response.data.email
        };
        this.formData = {
          name: this.currentUser.name,
          email: this.currentUser.email
        };
      } catch (error) {
        console.error('Failed to load user data:', error);
        this.profileError = 'Failed to load user data. Please refresh the page.';
      }
    },
    calculatePasswordStrength(password) {
      let strength = 0;
      if (password.length > 7) strength++;
      if (password.match(/[a-z]/)) strength++;
      if (password.match(/[A-Z]/)) strength++;
      if (password.match(/[0-9]/)) strength++;
      if (password.match(/[^a-zA-Z0-9]/)) strength++;
      return strength;
    },
    async saveProfile() {
      this.profileSuccess = false;
      this.profileError = '';
      
      if (!this.formData.name.trim()) {
        this.profileError = 'Name is required';
        return;
      }
      
      this.isSavingProfile = true;
      
      try {
        const response = await axios.put('/current-user', {
          name: this.formData.name,
          email: this.formData.email
        });

        this.currentUser = {
          name: this.formData.name,
          email: this.formData.email
        };
        
        this.profileSuccess = true;
        setTimeout(() => {
          this.profileSuccess = false;
        }, 3000);
      } catch (error) {
        if (error.response) {
          const { status, data } = error.response;
          if (status === 422 && data.errors) {
            this.profileError = Object.values(data.errors).join(' ');
          } else {
            this.profileError = data.message || 'Failed to update profile. Please try again.';
          }
        } else {
          this.profileError = 'Network error. Please check your connection.';
        }
      } finally {
        this.isSavingProfile = false;
      }
    },
    async changePassword() {
      this.passwordSuccess = false;
      this.passwordError = '';
      
      if (!this.passwordData.current_password) {
        this.passwordError = 'Current password is required';
        return;
      }
      
      if (!this.passwordData.new_password) {
        this.passwordError = 'New password is required';
        return;
      }
      
      if (this.passwordData.new_password.length < 8) {
        this.passwordError = 'Password must be at least 8 characters';
        return;
      }
      
      if (this.passwordMismatch) {
        this.passwordError = 'Passwords do not match';
        return;
      }
      
      this.isChangingPassword = true;
      
      try {
        await axios.put('/current-user/password', this.passwordData);
        
        this.passwordSuccess = true;
        setTimeout(() => {
          this.passwordSuccess = false;
        }, 3000);
        
        this.passwordData = {
          current_password: '',
          new_password: '',
          new_password_confirmation: ''
        };
      } catch (error) {
        if (error.response) {
          const { status, data } = error.response;
          if (status === 401) {
            this.passwordError = 'Current password is incorrect';
          } else {
            this.passwordError = data.message || 'Failed to change password. Please try again.';
          }
        } else {
          this.passwordError = 'Network error. Please check your connection.';
        }
      } finally {
        this.isChangingPassword = false;
      }
    }
  }
};
</script>

<style scoped>
.settings-page {
  width: 100%;
  height: calc(100vh - 40px);
  padding: 1rem;
  background: #FFFFFF;
  font-family: 'Raleway', sans-serif;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  gap: 2rem;
  overflow: hidden;
}

.settings-section {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.section-header {
  display: flex;
  align-items: flex-start;
  gap: 0.75rem;
  margin-top: -0.5rem;
}

.icon-container {
  width: 40px;
  height: 40px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 0.25rem;
}

.green-bg {
  background-color: #10B982;
  color: white;
}

.icon-container i {
  font-size: 1.25rem;
}

h1, h2 {
  font-size: 1.25rem;
  font-weight: 600;
  color: #1E293B;
  margin: 0;
  padding-top: 0.25rem;
}

.subtitle {
  color: #64748B;
  margin: 0;
  font-size: 0.7rem;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  padding-left: 3.25rem;
  margin-top: -1.5rem;
  text-transform: lowercase;
}

.divider {
  height: 1px;
  background-color: #E2E8F0;
  margin: 0.5rem 0 1rem 0;
  width: 100%;
}

.settings-content {
  padding-left: 0;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.form-group {
  margin-bottom: 0;
}

.form-group label {
  display: block;
  margin-bottom: 0.4rem;
  font-size: 0.8rem;
  color: #475569;
  font-weight: 500;
}

.form-input {
  width: 100%;
  max-width: 400px;
  padding: 0.6rem 0.8rem;
  border: 1px solid #E2E8F0;
  border-radius: 6px;
  font-size: 0.8rem;
  background: #FFFFFF;
  transition: border-color 0.2s;
}

.form-input::placeholder {
  color: #94A3B8;
  opacity: 1;
}

.form-input:focus {
  outline: none;
  border-color: #10B982;
  box-shadow: 0 0 0 2px rgba(16, 185, 130, 0.1);
}

.action-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.6rem 1rem;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.8rem;
  font-weight: 500;
  width: 170px;
  background: #10B982;
}

.action-btn:hover:not(:disabled) {
  background: #10B982;
}

.action-btn:disabled {
  opacity: 0.7;
  cursor: not-allowed;
  background: #00935d;
}

.action-btn i {
  font-size: 0.9rem;
}

.success-message {
  margin-top: 1rem;
  padding: 0.5rem;
  background-color: #ECFDF5;
  color: #065F46;
  border-radius: 4px;
  font-size: 0.8rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.error-message {
  margin-top: 1rem;
  padding: 0.5rem;
  background-color: #FEF2F2;
  color: #B91C1C;
  border-radius: 4px;
  font-size: 0.8rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.password-hint {
  font-size: 0.7rem;
  color: #64748B;
  margin-top: 0.3rem;
}
</style>