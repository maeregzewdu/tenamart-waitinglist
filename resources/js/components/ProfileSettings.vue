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
      
      <div class="settings-box">
        <p class="subtitle">EDIT YOUR NAME AND EMAIL</p>
        
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-input" :placeholder="currentUser.name">
        </div>
        
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-input" placeholder="Enter your email">
        </div>
        
        <button class="action-btn">
          <div class="icon-container green-bg">
            <i class="ri-save-line"></i>
          </div>
          <span>Save changes</span>
        </button>
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
      
      <div class="settings-box">
        <p class="subtitle">CHANGE YOUR PASSWORD</p>
        
        <div class="form-group">
          <label>Current password</label>
          <input type="password" class="form-input" placeholder="Enter current password">
        </div>
        
        <div class="form-group">
          <label>New password</label>
          <input type="password" class="form-input" placeholder="Enter new password">
        </div>
        
        <div class="form-group">
          <label>Confirm new password</label>
          <input type="password" class="form-input" placeholder="Confirm new password">
        </div>
        
        <button class="action-btn">
          <div class="icon-container green-bg">
            <i class="ri-save-line"></i>
          </div>
          <span>Save changes</span>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProfileSettings',
  data() {
    return {
      currentUser: {
        name: 'Saron Yirga', // This would normally come from your user data
        email: 'saronyirga@gmail.com'
      }
    };
  }
};
</script>

<style scoped>
.settings-page {
  width: 100%;
  height: 100%;
  padding: 1.5rem;
  background: #FFFFFF;
  font-family: 'Raleway', sans-serif;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  gap: 2rem;
  overflow-y: auto;
}

.settings-section {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.section-header {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.icon-container {
  width: 48px;
  height: 48px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.green-bg {
  background-color: #10B982;
  color: white;
}

.icon-container i {
  font-size: 1.5rem;
}

h1, h2 {
  font-size: 1.5rem;
  font-weight: 600;
  color: #1E293B;
  margin: 0;
}

.subtitle {
  color: #64748B;
  margin: 0 0 1.5rem 0;
  font-size: 0.9rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.settings-box {
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 1.5rem;
  background: #FFFFFF;
  box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.form-group {
  margin-bottom: 1.25rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-size: 0.875rem;
  color: #475569;
  font-weight: 500;
}

.form-input {
  width: 100%;
  padding: 0.75rem 1rem;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  font-size: 0.875rem;
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
  box-shadow: 0 0 0 3px rgba(16, 185, 130, 0.1);
}

.action-btn {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem 1.25rem;
  background: #F1F5F9;
  color: #1E293B;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 0.875rem;
  font-weight: 500;
  transition: all 0.2s;
  margin-top: 0.5rem;
}

.action-btn:hover {
  background: #E2E8F0;
  transform: translateY(-1px);
}

.action-btn .icon-container {
  width: 32px;
  height: 32px;
}

.action-btn .icon-container i {
  font-size: 1rem;
}
</style>