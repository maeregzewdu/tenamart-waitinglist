<template>
  <div class="statistics-page" @click="closeAllDropdowns">
    <!-- Loading Overlay -->
    <div class="loading-overlay" v-if="isLoading">
      <div class="loading-spinner"></div>
    </div>

    <!-- Top Control Bar -->
    <div class="top-control-bar">
      <div class="right-controls">
        <div class="source-filter" @click.stop="toggleSourceDropdown">
          <span>{{ selectedSource || 'Source' }}</span>
          <i class="ri-arrow-down-s-line"></i>
          <div class="source-dropdown" v-if="showSourceDropdown">
            <div @click="applySourceFilter('')">All Sources</div>
            <div 
              v-for="source in sources" 
              :key="source" 
              @click="applySourceFilter(source)"
            >
              {{ source }}
            </div>
          </div>
        </div>

        <div class="time-filter" @click.stop>
          <i class="ri-calendar-line"></i>
          <span 
            v-for="days in [1, 3, 7, 30]" 
            :key="days" 
            :class="{ active: selectedDays === days }"
            @click="applyDaysFilter(days)"
          >
            {{ days }}d
          </span>
          <span 
            :class="{ active: selectedDays === null }"
            @click="applyDaysFilter(null)"
          >
            All
          </span>
        </div>

        <div class="filter-btn" @click.stop="toggleTimeframeDropdown">
          <i class="ri-filter-line"></i>
          <span>Filter</span>
          <i class="ri-arrow-down-s-line"></i>
          <div class="timeframe-dropdown" v-if="showTimeframeDropdown">
            <div 
              v-for="timeframe in timeframes" 
              :key="timeframe.value"
              :class="{ active: selectedTimeframe === timeframe.value }"
              @click="applyTimeframeFilter(timeframe.value)"
            >
              {{ timeframe.label }}
            </div>
          </div>
        </div>
        
        <button class="download-btn" @click="downloadReport">
          <i class="ri-download-line"></i>
          <span>Download Report</span>
        </button>
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
      <div class="stats-card">
        <div class="icon-container">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.89 22 5.99 22H18C19.1 22 20 21.1 20 20V8L14 2ZM6 20V4H13V9H18V20H6Z" fill="white"/>
            <path d="M8 10H16V12H8V10ZM8 14H16V16H8V14ZM8 18H13V20H8V18Z" fill="white"/>
          </svg>
        </div>
        <div class="stats-text">
          <div class="stat-title">Total waiting list</div>
          <div class="stat-value">{{ stats.total }}</div>
        </div>
      </div>
      
      <div class="stats-card">
        <div class="icon-container">
          <i class="ri-add-line"></i>
        </div>
        <div class="stats-text">
          <div class="stat-title">New signups</div>
          <div class="stat-value">{{ stats.today }}</div>
        </div>
      </div>
      
      <div class="stats-card">
        <div class="icon-container">
          <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14.0012 2.33333C20.4444 2.33333 25.6678 7.55667 25.6678 14C25.6678 19.1329 22.3531 23.4914 17.7476 25.0521L17.4835 25.138L14.0957 16.3298C15.3428 16.275 16.3345 15.2301 16.3345 14C16.3345 12.7113 15.2897 11.6667 14.0012 11.6667C12.7125 11.6667 11.6678 12.7113 11.6678 14C11.6678 15.2563 12.6605 16.2806 13.9043 16.3313L10.5175 25.1377L10.2547 25.0521C5.64914 23.4914 2.33447 19.1329 2.33447 14C2.33447 7.55667 7.55782 2.33333 14.0012 2.33333ZM14.0012 4.66666C8.84648 4.66666 4.66781 8.84533 4.66781 14C4.66781 17.4068 6.49304 20.3871 9.21897 22.0167L10.945 17.5268C9.95843 16.6712 9.33447 15.4085 9.33447 14C9.33447 11.4227 11.4238 9.33333 14.0012 9.33333C16.5784 9.33333 18.6678 11.4227 18.6678 14C18.6678 15.4087 18.0437 16.6717 17.0567 17.5273C17.7171 19.2464 18.293 20.7437 18.7831 22.0184C21.5089 20.3876 23.3345 17.407 23.3345 14C23.3345 8.84533 19.1558 4.66666 14.0012 4.66666Z" fill="white"/>
          </svg>
        </div>
        <div class="stats-text">
          <div class="stat-title">Top source</div>
          <div class="stat-value">{{ stats.topSource }}</div>
        </div>
      </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-section">
      <div class="chart-card">
        <div class="chart-header">
          <h3>Signups Trend</h3>
        </div>
        <div class="chart-container">
          <canvas ref="trendChart"></canvas>
        </div>
      </div>
      
      <div class="chart-row">
        <div class="chart-card half-width">
          <div class="chart-header">
            <h3>Signup Sources</h3>
          </div>
          <div class="chart-container">
            <canvas ref="sourceChart"></canvas>
          </div>
        </div>
        
        <div class="chart-card half-width">
          <div class="chart-header">
            <h3>Signup Sources</h3>
          </div>
          <div class="chart-container">
            <canvas ref="sourceBarChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Chart from 'chart.js/auto';
import axios from 'axios';

export default {
  name: 'Statistics',
  data() {
    return {
      selectedSource: '',
      selectedDays: null,
      selectedTimeframe: null,
      showSourceDropdown: false,
      showTimeframeDropdown: false,
      isLoading: false,
      
      // Chart references
      trendChart: null,
      sourceChart: null,
      sourceBarChart: null,
      
      sources: ['facebook', 'linkedIn', 'youtube', 'instagram', 'telegram', 'organic'],
      timeframes: [
        { label: 'Today', value: 'today' },
        { label: 'Last 3 days', value: '3d' },
        { label: 'Last 7 days', value: '7d' },
        { label: 'Last 30 days', value: '30d' },
        { label: 'All time', value: 'all' }
      ],
      stats: {
        total: 0,
        today: 0,
        topSource: ''
      },
      trendData: [],
      topSourcesData: [],
      initialDataLoaded: false
    }
  },
  async created() {
    await this.initializeComponent();
  },
  beforeUnmount() {
    this.cleanupCharts();
  },
  methods: {
    async initializeComponent() {
      this.isLoading = true;
      try {
        await this.fetchInitialData();
        await this.fetchStatsData();
        await this.renderAllCharts();
        this.initialDataLoaded = true;
      } catch (error) {
        console.error('Initialization error:', error);
        this.showErrorNotification('Failed to initialize data. Please try again.');
      } finally {
        this.isLoading = false;
      }
    },

    cleanupCharts() {
      if (this.trendChart) {
        this.trendChart.destroy();
        this.trendChart = null;
      }
      if (this.sourceChart) {
        this.sourceChart.destroy();
        this.sourceChart = null;
      }
      if (this.sourceBarChart) {
        this.sourceBarChart.destroy();
        this.sourceBarChart = null;
      }
    },

    async refreshStats() {
      this.isLoading = true;
      try {
        await this.fetchStatsData();
      } catch (error) {
        console.error('Refresh error:', error);
        this.showErrorNotification('Failed to refresh data. Please try again.');
      } finally {
        this.isLoading = false;
      }
    },

    async fetchInitialData() {
      try {
        const response = await axios.get('/waiting-list/stats');
        const data = response.data;
        
        this.trendData = data.trend || [];
        this.topSourcesData = data.top_sources || [];
        
      } catch (error) {
        console.error('Error fetching initial data:', error);
        this.trendData = [];
        this.topSourcesData = [];
        throw error;
      }
    },

    async fetchStatsData() {
      try {
        const params = {};
        
        if (this.selectedSource) {
          params.signup_source = this.selectedSource;
        }
        
        if (this.selectedDays !== null) {
          params.days = this.selectedDays;
        }
        
        if (this.selectedTimeframe !== null) {
          params.timeframe = this.selectedTimeframe;
        }
        
        const response = await axios.get('/waiting-list/stats', { params });
        const data = response.data;
        
        this.stats = {
          total: data.stats.total,
          today: data.stats.today,
          topSource: data.stats.top_source ? data.stats.top_source.signup_source : 'None'
        };
        
      } catch (error) {
        console.error('Error fetching stats:', error);
        this.stats = {
          total: 0,
          today: 0,
          topSource: ''
        };
        throw error;
      }
    },

    async renderAllCharts() {
      if (this.trendData.length === 0 && this.topSourcesData.length === 0) {
        this.cleanupCharts();
        this.showEmptyState();
        return;
      }
      
      try {
        if (!this.$refs.trendChart || !this.$refs.sourceChart || !this.$refs.sourceBarChart) {
          throw new Error('Canvas elements not found');
        }
        
        this.cleanupCharts();
        
        await new Promise(resolve => requestAnimationFrame(resolve));
        
        await this.renderTrendChart();
        await this.renderSourceDoughnutChart();
        await this.renderSourceBarChart();
      } catch (error) {
        console.error('Chart rendering error:', error);
        this.cleanupCharts();
        this.showErrorNotification('Failed to render charts. Please try again.');
      }
    },
    
    async renderTrendChart() {
      return new Promise((resolve) => {
        const trendLabels = this.trendData.map(item => {
          const date = new Date(item.date);
          return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
        });
        
        const trendValues = this.trendData.map(item => item.count);
        
        const trendCtx = this.$refs.trendChart.getContext('2d');
        this.trendChart = new Chart(trendCtx, {
          type: 'line',
          data: {
            labels: trendLabels,
            datasets: [{
              label: 'Signups',
              data: trendValues,
              borderColor: '#10B982',
              backgroundColor: 'rgba(16, 185, 130, 0.1)',
              tension: 0.3,
              fill: true,
              borderWidth: 2,
              pointRadius: 3,
              pointBackgroundColor: '#10B982'
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: { display: false },
              tooltip: {
                mode: 'index',
                intersect: false
              }
            },
            scales: {
              y: { 
                beginAtZero: true,
                grid: {
                  color: 'rgba(226, 232, 240, 0.5)'
                }
              },
              x: {
                grid: {
                  display: false
                }
              }
            }
          }
        });
        resolve();
      });
    },
    
    async renderSourceDoughnutChart() {
      return new Promise((resolve) => {
        const sourceLabels = this.topSourcesData.map(item => item.signup_source);
        const sourceData = this.topSourcesData.map(item => item.total);
        
        const sourceCtx = this.$refs.sourceChart.getContext('2d');
        this.sourceChart = new Chart(sourceCtx, {
          type: 'doughnut',
          data: {
            labels: sourceLabels,
            datasets: [{
              data: sourceData,
              backgroundColor: [
                '#10B982', '#3B82F6', '#F59E0B', '#8B5CF6', '#EC4899', '#14B8A6', '#F97316'
              ],
              borderWidth: 0
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
              padding: {
                top: 10,
                bottom: 10,
                left: 10,
                right: 10
              }
            },
            plugins: {
              legend: {
                position: 'right',
                labels: {
                  boxWidth: 12,
                  padding: 10,
                  font: {
                    size: 11
                  }
                }
              },
              tooltip: {
                callbacks: {
                  label: function(context) {
                    const label = context.label || '';
                    const value = context.raw || 0;
                    const total = context.dataset.data.reduce((acc, data) => acc + data, 0);
                    const percentage = Math.round((value / total) * 100);
                    return `${label}: ${value} (${percentage}%)`;
                  }
                }
              }
            },
            cutout: '65%'
          }
        });
        resolve();
      });
    },
    
    async renderSourceBarChart() {
      return new Promise((resolve) => {
        const sourceLabels = this.topSourcesData.map(item => item.signup_source);
        const sourceData = this.topSourcesData.map(item => item.total);
        
        const sourceBarCtx = this.$refs.sourceBarChart.getContext('2d');
        this.sourceBarChart = new Chart(sourceBarCtx, {
          type: 'bar',
          data: {
            labels: sourceLabels,
            datasets: [{
              label: 'Signups',
              data: sourceData,
              backgroundColor: [
                '#10B982', '#3B82F6', '#F59E0B', '#8B5CF6', '#EC4899', '#14B8A6', '#F97316'
              ],
              borderWidth: 0,
              borderRadius: 4
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
              padding: {
                left: 10,
                right: 10,
                top: 10,
                bottom: 10
              }
            },
            plugins: {
              legend: { display: false },
              tooltip: {
                callbacks: {
                  label: function(context) {
                    return `${context.parsed.y} signups`;
                  }
                }
              }
            },
            scales: {
              y: { 
                beginAtZero: true,
                grid: {
                  color: 'rgba(226, 232, 240, 0.5)'
                },
                ticks: {
                  padding: 5
                }
              },
              x: {
                grid: {
                  display: false
                },
                ticks: {
                  padding: 5,
                  autoSkip: false,
                  maxRotation: 45,
                  minRotation: 45
                }
              }
            }
          }
        });
        resolve();
      });
    },
    
    // Filter application methods
    async applySourceFilter(source) {
      this.selectedSource = source;
      this.showSourceDropdown = false;
      this.selectedDays = null;
      this.selectedTimeframe = null;
      await this.refreshStats();
    },
    
    async applyDaysFilter(days) {
      this.selectedDays = days;
      this.selectedTimeframe = null;
      await this.refreshStats();
    },
    
    async applyTimeframeFilter(timeframe) {
      this.selectedTimeframe = timeframe;
      this.selectedDays = null;
      this.showTimeframeDropdown = false;
      await this.refreshStats();
    },
    
    toggleSourceDropdown() {
      this.showSourceDropdown = !this.showSourceDropdown;
      if (this.showSourceDropdown) {
        this.showTimeframeDropdown = false;
      }
    },
    
    toggleTimeframeDropdown() {
      this.showTimeframeDropdown = !this.showTimeframeDropdown;
      if (this.showTimeframeDropdown) {
        this.showSourceDropdown = false;
      }
    },
    
    closeAllDropdowns() {
      this.showSourceDropdown = false;
      this.showTimeframeDropdown = false;
    },
    
    downloadReport() {
      try {
        let csvContent = "Report Generated At," + new Date().toLocaleString() + "\n\n";
        csvContent += "Current Filters:\n";
        csvContent += `Source,${this.selectedSource || 'All'}\n`;
        csvContent += `Days Filter,${this.selectedDays ? this.selectedDays + 'd' : 'None'}\n`;
        csvContent += `Timeframe,${this.selectedTimeframe ? this.timeframes.find(t => t.value === this.selectedTimeframe).label : 'None'}\n\n`;
        
        csvContent += "Summary Statistics:\n";
        csvContent += `Total Waiting List,${this.stats.total}\n`;
        csvContent += `New Signups Today,${this.stats.today}\n`;
        csvContent += `Top Source,${this.stats.topSource}\n\n`;
        
        // Add trend data
        csvContent += "Trend Data:\n";
        csvContent += "Date,Count\n";
        this.trendData.forEach(item => {
          csvContent += `${item.date},${item.count}\n`;
        });
        
        csvContent += "\n";
        
        // Add top sources data
        csvContent += "Top Sources:\n";
        csvContent += "Source,Count\n";
        this.topSourcesData.forEach(item => {
          csvContent += `${item.signup_source},${item.total}\n`;
        });
        
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        
        link.setAttribute('href', url);
        link.setAttribute('download', `report_${new Date().toISOString().slice(0,10)}.csv`);
        link.style.visibility = 'hidden';
        
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      } catch (error) {
        console.error('Error generating report:', error);
        this.showErrorNotification('Failed to generate report. Please try again.');
      }
    },
    
    showEmptyState() {
      console.log('No data available for the current filters');
    },
    
    showErrorNotification(message) {
      console.error('Error:', message);
      alert(message);
    }
  }
};
</script>

<style scoped>
.statistics-page {
  width: 100%;
  height: calc(100vh - 40px);
  padding: 1rem;
  background: #FFFFFF;
  font-family: 'Raleway', sans-serif;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  position: relative;
}

.loading-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(255, 255, 255, 0.8);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.loading-spinner {
  border: 4px solid rgba(16, 185, 130, 0.2);
  border-radius: 50%;
  border-top: 4px solid #10B982;
  width: 40px;
  height: 40px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.top-control-bar {
  width: 100%;
  height: 50px;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  margin-bottom: 1rem;
}

.right-controls {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  position: relative;
}

.source-filter, .filter-btn {
  display: flex;
  align-items: center;
  padding: 0 0.75rem;
  background: #FFFFFF;
  border: 1px solid 'rgba(226, 232, 240, 1)';
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.8rem;
  height: 36px;
  white-space: nowrap;
  position: relative;
  user-select: none;
  transition: all 0.2s ease;
}

.source-filter:hover, .filter-btn:hover {
  border-color: #CBD5E1;
}

.source-filter i, .filter-btn i {
  margin-left: 0.5rem;
  font-size: 1rem;
  transition: transform 0.2s ease;
}

.source-filter:hover i, .filter-btn:hover i {
  transform: translateY(1px);
}

.filter-btn i:first-child {
  margin-left: 0;
  margin-right: 0.5rem;
}

.source-dropdown, .timeframe-dropdown {
  position: absolute;
  top: 100%;
  left: 0;
  background: white;
  border: 1px solid 'rgba(226, 232, 240, 1)';
  border-radius: 6px;
  width: 100%;
  z-index: 10;
  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
  max-height: 300px;
  overflow-y: auto;
  animation: fadeIn 0.2s ease-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-5px); }
  to { opacity: 1; transform: translateY(0); }
}

.source-dropdown div, .timeframe-dropdown div {
  padding: 0.5rem 0.75rem;
  cursor: pointer;
  transition: background-color 0.1s ease;
}

.source-dropdown div:first-child, .timeframe-dropdown div:first-child {
  font-weight: bold;
}

.source-dropdown div:hover, .timeframe-dropdown div:hover {
  background: #F8FAFC;
}

.source-dropdown div.active, .timeframe-dropdown div.active {
  background: #F1F5F9;
  color: #10B982;
}

.time-filter {
  display: flex;
  align-items: center;
  background: #FFFFFF;
  border: 1px solid 'rgba(226, 232, 240, 1)';
  border-radius: 6px;
  height: 36px;
  overflow: hidden;
  transition: all 0.2s ease;
}

.time-filter:hover {
  border-color: #CBD5E1;
}

.time-filter i {
  padding: 0 0.5rem;
  color: #64748B;
  border-right: 1px solid 'rgba(226, 232, 240, 1)';
  height: 100%;
  display: flex;
  align-items: center;
  font-size: 1rem;
}

.time-filter span {
  padding: 0 0.75rem;
  font-size: 0.8rem;
  cursor: pointer;
  border-right: 1px solid 'rgba(226, 232, 240, 1)';
  height: 100%;
  display: flex;
  align-items: center;
  transition: all 0.2s ease;
}

.time-filter span:last-child {
  border-right: none;
}

.time-filter span:hover {
  background: #F1F5F9;
}

.time-filter span.active {
  background: #10B982;
  color: white;
}

.download-btn {
  display: flex;
  align-items: center;
  padding: 0 0.75rem;
  background: #10B982;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.8rem;
  height: 36px;
  white-space: nowrap;
  transition: all 0.2s ease;
}

.download-btn:hover {
  background: #0E9F76;
}

.download-btn i {
  margin-right: 0.5rem;
  font-size: 1rem;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1rem;
  margin-bottom: 1rem;
}

.stats-card {
  background: #FFFFFF;
  border: 1px solid 'rgba(226, 232, 240, 1)';
  border-radius: 8px;
  padding: 1rem;
  display: flex;
  align-items: center;
  gap: 1rem;
  box-shadow: 0 1px 2px rgba(0,0,0,0.05);
  transition: all 0.2s ease;
}

.stats-card:hover {
  box-shadow: 0 4px 6px rgba(0,0,0,0.05);
  transform: translateY(-2px);
}

.icon-container {
  width: 48px;
  height: 48px;
  background: #10B982;
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
}

.stats-card:hover .icon-container {
  transform: scale(1.05);
}

.icon-container i {
  font-size: 1.5rem;
  color: white;
}

.stats-text {
  display: flex;
  flex-direction: column;
}

.stat-title {
  font-size: 0.8rem;
  color: #64748B;
  margin-bottom: 0.25rem;
}

.stat-value {
  font-size: 1.5rem;
  font-weight: 700;
  color: #000000;
}

.charts-section {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  flex: 1;
  min-height: 0;
}

.chart-card {
  background: #FFFFFF;
  border: 1px solid 'rgba(226, 232, 240, 1)';
  border-radius: 8px;
  padding: 1rem;
  box-shadow: 0 1px 2px rgba(0,0,0,0.05);
  flex: 1;
  min-height: 0;
  display: flex;
  flex-direction: column;
  transition: all 0.2s ease;
}

.chart-card:hover {
  box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}

.chart-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.chart-header h3 {
  font-size: 0.9rem;
  font-weight: 600;
  color: #000000;
}

.chart-container {
  flex: 1;
  min-height: 200px;
  position: relative;
  width: 100%;
  height: 100%;
  padding: 5px;
}

.half-width {
  flex: 1;
  min-width: 0;
}

.chart-row {
  display: flex;
  gap: 1rem;
  flex: 1;
  min-height: 0;
}

@media (max-width: 768px) {
  .stats-grid {
    grid-template-columns: 1fr;
  }
  
  .chart-row {
    flex-direction: column;
  }
  
  .half-width {
    width: 100%;
  }
  
  .right-controls {
    flex-wrap: wrap;
    height: auto;
    padding: 0.5rem 0;
  }
  
  .source-filter, 
  .time-filter,
  .filter-btn,
  .download-btn {
    margin-bottom: 0.5rem;
  }
}
</style>