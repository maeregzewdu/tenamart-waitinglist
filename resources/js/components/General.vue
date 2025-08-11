<template>
    <div class="general-content">
        <!-- Stats Cards -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="card-content">
                    <p class="card-label">Total waiting list</p>
                    <p class="card-value">43</p>
                </div>
                <div class="card-icon">
                    <i class="ri-list-check"></i>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="card-content">
                    <p class="card-label">Total admins</p>
                    <p class="card-value">6</p>
                </div>
                <div class="card-icon">
                    <i class="ri-user-line"></i>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="card-content">
                    <p class="card-label">Top source</p>
                    <p class="card-value">LinkedIn</p>
                </div>
                <div class="card-icon">
                    <i class="ri-linkedin-box-fill"></i>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <div class="left-column">
                <!-- Recent Activities -->
                <div class="recent-activities">
                    <div class="section-header">
                        <div class="header-icon">
                            <i class="ri-history-line"></i>
                        </div>
                        <div>
                            <h2>Recent Activities</h2>
                            <p>see all the recent activities in this site</p>
                        </div>
                        <p class="time-filter">Last 24 hours</p>
                    </div>
                    <div class="divider"></div>
                    <div class="activities-list">
                        <!-- Activity items would go here -->
                    </div>
                </div>
            </div>
            
            <div class="right-column">
                <!-- Quick Actions -->
                <div class="quick-actions">
                    <div class="section-header">
                        <div class="header-icon">
                            <i class="ri-flashlight-line"></i>
                        </div>
                        <div>
                            <h2>Quick Actions</h2>
                            <p>shortcuts to common tasks</p>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="action-buttons">
                        <!-- Quick action buttons would go here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'General'
};
</script>

<style scoped>
.general-content {
    height: 100%;
}

.stats-cards {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.stat-card {
    flex: 1;
    background: #FFFFFF;
    border: 1px solid #E5E5E5;
    border-radius: 10px;
    padding: 20px;
    position: relative;
}

.card-content {
    margin-bottom: 10px;
}

.card-label {
    font-family: 'Raleway';
    font-weight: 500;
    font-size: 18px;
    color: #505050;
}

.card-value {
    font-family: 'Raleway';
    font-weight: 700;
    font-size: 32px;
    color: #000000;
}

.card-icon {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    width: 65px;
    height: 65px;
    background: #10B982;
    opacity: 0.75;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card-icon i {
    color: white;
    font-size: 24px;
}

.content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
    height: calc(100% - 150px);
}

.left-column, .right-column {
    background: #FFFFFF;
    border: 1px solid #E5E5E5;
    border-radius: 10px;
    padding: 20px;
}

.section-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.header-icon {
    width: 50px;
    height: 50px;
    background: #10B982;
    opacity: 0.75;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
}

.header-icon i {
    color: white;
    font-size: 24px;
}

.divider {
    width: 100%;
    height: 1px;
    background: #D9D9D9;
    margin-bottom: 20px;
}
</style>