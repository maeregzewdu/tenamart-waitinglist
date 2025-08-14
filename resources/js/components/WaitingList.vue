<template>
  <div class="waiting-list-container">
    <!-- Top Control Bar - Fixed Position -->
    <div class="top-control-bar">
      <div class="left-controls">
        <div class="search-container">
          <i class="ri-search-line"></i>
          <input type="text" placeholder="Search..." class="search-input">
        </div>
        
        <div class="source-filter">
          <span>Source</span>
          <i class="ri-arrow-down-s-line"></i>
        </div>
        
        <div class="time-filter">
          <i class="ri-calendar-line"></i>
          <span>1d</span>
          <span>3d</span>
          <span>7d</span>
          <span>30d</span>
          <span>All</span>
        </div>
      </div>
      
      <div class="right-controls">
        <div class="filter-box">
          <i class="ri-filter-line"></i>
          <span>Filter</span>
        </div>
        
        <button class="download-btn">
          <i class="ri-download-line"></i>
          <span>Download Excel</span>
        </button>
      </div>
    </div>

    <!-- Stats Card -->
    <div class="stats-card">
      <div class="icon-container">
        <i class="ri-file-list-3-line"></i>
      </div>
      <div class="stats-text">
        <div class="stat-title">Total waiting list</div>
        <div class="stat-value">43</div>
      </div>
    </div>

    <!-- User Grid - Fixed Size (No Scrolling) -->
    <div class="user-grid">
      <div class="user-card" v-for="(user, index) in waitingList.slice(0,6)" :key="index">
        <div class="user-avatar">
          {{ user.name.charAt(0).toUpperCase() }}
        </div>
        <div class="user-info">
          <h3>{{ user.name }}</h3>
          <a :href="'mailto:' + user.email" class="user-email">{{ user.email }}</a>
          <div class="user-source">{{ user.source }}</div>
        </div>
        
        <!-- Action Buttons Moved to Left -->
        <div class="action-buttons">
          <button class="action-btn view">
            <i class="ri-eye-line"></i>
            <span>View</span>
          </button>
          <button class="action-btn edit">
            <i class="ri-edit-line"></i>
            <span>Edit</span>
          </button>
          <button class="action-btn delete">
            <i class="ri-delete-bin-line"></i>
            <span>Delete</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Pagination -->
    <div class="pagination-bar">
      <div class="page-info">Showing 1 of 5 pages</div>
      <div class="page-controls">
        <button class="page-nav">
          <i class="ri-arrow-left-s-line"></i>
        </button>
        <button class="page-number active">1</button>
        <button class="page-number">2</button>
        <button class="page-number">3</button>
        <button class="page-number">4</button>
        <button class="page-number">5</button>
        <button class="page-nav">
          <i class="ri-arrow-right-s-line"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'WaitingList',
  data() {
    return {
      waitingList: [
        {
          name: "Biruk F/Selasie",
          email: "birukfikresilasie@gmail.com",
          source: "LinkedIn"
        },
        {
          name: "Selsabel Yousef",
          email: "selsabel.yousef@gmail.com",
          source: "Organic"
        },
        {
          name: "Meklit Haltu",
          email: "meklithaltu@gmail.com",
          source: "Instagram"
        },
        {
          name: "Elsabet Yohannes",
          email: "elsabetyohannes@gmail.com",
          source: "Organic"
        },
        {
          name: "Obsan Zena",
          email: "obsanzena@gmail.com",
          source: "Telegram"
        },
        {
          name: "Abel Ermias",
          email: "abelermias@gmail.com",
          source: "TRICK"
        }
      ]
    }
  }
}
</script>

<style scoped>
/* Base Container - No Scrolling */
.waiting-list-container {
  width: 100%;
  height: 100vh;
  padding: 1.5rem;
  background: #FFFFFF;
  font-family: 'Raleway', sans-serif;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  overflow: hidden; /* Disables scrolling */
  position: relative; /* For absolute positioning of children */
}

/* Top Control Bar - Fixed Position */
.top-control-bar {
  width: calc(100% - 3rem); /* Account for container padding */
  height: 60px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
  position: sticky;
  top: 0;
  background: white;
  z-index: 10;
  padding-top: 0.5rem;
}

.left-controls {
  display: flex;
  align-items: center;
  gap: 15px;
}

.right-controls {
  display: flex;
  align-items: center;
  gap: 15px;
}

.search-container {
  display: flex;
  align-items: center;
  background: #F8FAFC;
  border-radius: 8px;
  padding: 0 15px;
  height: 45px;
  width: 280px;
}

.search-container i {
  color: #94A3B8;
  margin-right: 10px;
  font-size: 18px;
}

.search-input {
  border: none;
  background: transparent;
  outline: none;
  width: 100%;
  font-size: 16px;
}

.source-filter, .filter-box {
  display: flex;
  align-items: center;
  padding: 0 15px;
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
  height: 45px;
  white-space: nowrap;
}

.source-filter i, .filter-box i {
  margin-left: 10px;
  font-size: 18px;
}

.time-filter {
  display: flex;
  align-items: center;
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  height: 45px;
  overflow: hidden;
}

.time-filter i {
  padding: 0 15px;
  color: #64748B;
  border-right: 1px solid #E2E8F0;
  height: 100%;
  display: flex;
  align-items: center;
  font-size: 18px;
}

.time-filter span {
  padding: 0 15px;
  font-size: 16px;
  cursor: pointer;
  border-right: 1px solid #E2E8F0;
  height: 100%;
  display: flex;
  align-items: center;
}

.time-filter span:last-child {
  border-right: none;
}

.download-btn {
  display: flex;
  align-items: center;
  padding: 0 15px;
  background: #10B982;
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
  height: 45px;
  white-space: nowrap;
}

.download-btn i {
  margin-right: 10px;
  font-size: 18px;
}

/* Stats Card */
.stats-card {
  width: 314px;
  height: 130px;
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 1.5rem;
  margin-bottom: 1.5rem;
  display: flex;
  align-items: center;
  gap: 1.5rem;
}

.icon-container {
  width: 60px;
  height: 60px;
  background: #10B982;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.icon-container i {
  font-size: 2rem;
  color: white;
}

.stats-text {
  display: flex;
  flex-direction: column;
}

.stat-title {
  font-size: 1rem;
  color: #000000;
  margin-bottom: 0.5rem;
}

.stat-value {
  font-size: 2.2rem;
  font-weight: 700;
  color: #000000;
}

/* User Grid - Fixed Size */
.user-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-template-rows: repeat(2, 180px);
  gap: 1.2rem;
  margin-bottom: 1.5rem;
  flex: 1;
  overflow: hidden; /* Prevent scrolling */
}

.user-card {
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 1.2rem;
  display: flex;
  background: #FFFFFF;
  box-shadow: 0 2px 4px rgba(0,0,0,0.05);
  position: relative; /* For action buttons */
}

.user-avatar {
  width: 50px;
  height: 50px;
  background: #10B982;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: bold;
  font-size: 20px;
  margin-right: 1rem;
  flex-shrink: 0;
}

.user-info {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.user-info h3 {
  font-size: 1.1rem;
  font-weight: 600;
  color: #000000;
  margin-bottom: 0.5rem;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.user-email {
  display: block;
  font-size: 0.9rem;
  color: #000000;
  text-decoration: none;
  margin-bottom: 0.5rem;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.user-source {
  font-size: 0.9rem;
  color: #10B982;
  font-style: italic;
  margin-bottom: 0.5rem;
}

/* Action Buttons - Moved to Left */
.action-buttons {
  position: absolute;
  left: 1.2rem;
  bottom: 1.2rem;
  display: flex;
  gap: 0.8rem;
}

.action-btn {
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 6px;
  font-size: 0.9rem;
  cursor: pointer;
  transition: all 0.2s;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
}

.action-btn.view {
  background: #E2E8F0; /* Lighter grey */
  color: #000000;
}

.action-btn.edit {
  background: #10B982;
  color: white;
}

.action-btn.delete {
  background: #EF4444;
  color: white;
}

.action-btn i {
  font-size: 1rem;
}

/* Pagination - Fixed Position */
.pagination-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: calc(100% - 3rem); /* Account for container padding */
  position: sticky;
  bottom: 0;
  background: white;
  padding: 1rem 0;
  z-index: 10;
  border-top: 1px solid #E2E8F0;
}

.page-info {
  color: #64748B;
  font-size: 0.9rem;
}

.page-controls {
  display: flex;
  gap: 0.5rem;
}

.page-nav, .page-number {
  width: 2.2rem;
  height: 2.2rem;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid #E2E8F0;
  border-radius: 6px;
  background: #FFFFFF;
  cursor: pointer;
  font-size: 0.9rem;
}

.page-number.active {
  background: #10B982;
  color: white;
  border-color: #10B982;
}

.page-nav i {
  font-size: 1.1rem;
}
</style>