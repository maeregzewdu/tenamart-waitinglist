<template>
  <div class="statistics-page">
    <!-- Top Control Bar -->
    <div class="top-control-bar">
      <div class="left-controls">
        <div class="search-placeholder"></div>
      </div>
      
      <div class="right-controls">
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
        
        <div class="filter-box">
          <i class="ri-filter-line"></i>
          <span>Filter</span>
        </div>
        
        <button class="download-btn">
          <i class="ri-download-line"></i>
          <span>Download Report</span>
        </button>
      </div>
    </div>

    <!-- Stats Cards - All with 60x60px icon containers -->
    <div class="stats-grid">
      <div class="stats-card" style="width: 314px; height: 130px;">
        <div class="icon-container">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.89 22 5.99 22H18C19.1 22 20 21.1 20 20V8L14 2ZM6 20V4H13V9H18V20H6Z" fill="white"/>
            <path d="M8 10H16V12H8V10ZM8 14H16V16H8V14ZM8 18H13V20H8V18Z" fill="white"/>
          </svg>
        </div>
        <div class="stats-text">
          <div class="stat-title">Total waiting list</div>
          <div class="stat-value">43</div>
        </div>
      </div>
      
      <div class="stats-card">
        <div class="icon-container">
          <i class="ri-add-line" style="font-size: 2.5rem;"></i>
        </div>
        <div class="stats-text">
          <div class="stat-title">New signups today</div>
          <div class="stat-value">5</div>
        </div>
      </div>
      
      <div class="stats-card">
        <div class="icon-container">
          <svg width="32" height="32" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14.0012 2.33333C20.4444 2.33333 25.6678 7.55667 25.6678 14C25.6678 19.1329 22.3531 23.4914 17.7476 25.0521L17.4835 25.138L14.0957 16.3298C15.3428 16.275 16.3345 15.2301 16.3345 14C16.3345 12.7113 15.2897 11.6667 14.0012 11.6667C12.7125 11.6667 11.6678 12.7113 11.6678 14C11.6678 15.2563 12.6605 16.2806 13.9043 16.3313L10.5175 25.1377L10.2547 25.0521C5.64914 23.4914 2.33447 19.1329 2.33447 14C2.33447 7.55667 7.55782 2.33333 14.0012 2.33333ZM14.0012 4.66666C8.84648 4.66666 4.66781 8.84533 4.66781 14C4.66781 17.4068 6.49304 20.3871 9.21897 22.0167L10.945 17.5268C9.95843 16.6712 9.33447 15.4085 9.33447 14C9.33447 11.4227 11.4238 9.33333 14.0012 9.33333C16.5784 9.33333 18.6678 11.4227 18.6678 14C18.6678 15.4087 18.0437 16.6717 17.0567 17.5273C17.7171 19.2464 18.293 20.7437 18.7831 22.0184C21.5089 20.3876 23.3345 17.407 23.3345 14C23.3345 8.84533 19.1558 4.66666 14.0012 4.66666Z" fill="white"/>
          </svg>
        </div>
        <div class="stats-text">
          <div class="stat-title">Top source</div>
          <div class="stat-value">LinkedIn</div>
        </div>
      </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-section">
      <div class="chart-card">
        <div class="chart-header">
          <h3>Waiting list entry trend</h3>
          <div class="chart-actions">
            <button class="chart-action-btn">
              <i class="ri-more-2-fill"></i>
            </button>
          </div>
        </div>
        <div class="chart-placeholder"></div>
      </div>
      
      <div class="chart-row">
        <div class="chart-card half-width">
          <div class="chart-header">
            <h3>Sign up sources</h3>
            <div class="chart-actions">
              <button class="chart-action-btn">
                <i class="ri-more-2-fill"></i>
              </button>
            </div>
          </div>
          <div class="chart-placeholder"></div>
        </div>
        
        <div class="chart-card half-width">
          <div class="chart-header">
            <h3>Sign up sources</h3>
            <div class="chart-actions">
              <button class="chart-action-btn">
                <i class="ri-more-2-fill"></i>
              </button>
            </div>
          </div>
          <div class="chart-placeholder"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Statistics'
};
</script>

<style scoped>
/* Base Styles */
.statistics-page {
  width: 100%;
  height: 100vh;
  padding: 1.5rem;
  background: #FFFFFF;
  font-family: 'Raleway', sans-serif;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  overflow: auto;
}

/* Top Control Bar */
.top-control-bar {
  width: calc(100% - 3rem);
  height: 60px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
  position: sticky;
  top: 0;
  background: white;
  z-index: 10;
}

.left-controls {
  display: flex;
  align-items: center;
  gap: 15px;
}

.search-placeholder {
  width: 280px;
}

.right-controls {
  display: flex;
  align-items: center;
  gap: 15px;
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

/* Stats Grid */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem;
  margin-bottom: 1.5rem;
}

.stats-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 1.5rem;
  display: flex;
  align-items: center;
  gap: 1.5rem;
  box-shadow: 0 2px 4px rgba(0,0,0,0.05);
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

.icon-container i, .icon-container svg {
  color: white;
}

.stats-text {
  display: flex;
  flex-direction: column;
}

.stat-title {
  font-size: 1rem;
  color: #64748B;
  margin-bottom: 0.5rem;
}

.stat-value {
  font-size: 2.2rem;
  font-weight: 700;
  color: #000000;
}

/* Charts Section */
.charts-section {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  flex: 1;
}

.chart-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 1.5rem;
  box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.chart-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

.chart-header h3 {
  font-size: 1.1rem;
  font-weight: 600;
  color: #000000;
}

.chart-action-btn {
  background: transparent;
  border: none;
  color: #64748B;
  cursor: pointer;
  padding: 0.25rem;
}

.chart-placeholder {
  height: 300px;
  background: #F8FAFC;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #94A3B8;
}

.half-width {
  flex: 1;
}

.chart-row {
  display: flex;
  gap: 1.5rem;
}
</style>