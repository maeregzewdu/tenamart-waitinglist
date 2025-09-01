<template>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <template v-if="loading">
            <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
                <StatCardSkeleton />
                <StatCardSkeleton />
                <StatCardSkeleton />
            </div>
            <div class="md:col-span-2">
                <RecentActivitesSkeleton />
            </div>
            <!-- Right (Quick Actions) -->
            <div>
                <QuickActionsSkeleton />
            </div>
        </template>
        <template v-else>
            <!-- Full width stats row -->
            <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
                <StatCard
                    title="Total Waiting List"
                    :data="totalWaitingList"
                    icon="ri-file-list-3-fill"
                />
                <StatCard
                    title="Total Admins"
                    :data="totalAdmins"
                    icon="ri-user-settings-fill"
                />
                <StatCard
                    title="Top Source"
                    :data="popularSource"
                    icon="ri-bar-chart-2-fill"
                />
            </div>
            <!-- Left (Recent Activities) -->
            <div class="md:col-span-2">
                <RecentActivities :data="recentActivitiesList" class="mb-8" />
            </div>
            <!-- Right (Quick Actions) -->
            <div>
                <QuickActions class="mb-8" />
            </div>
        </template>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import QuickActions from "@/components/QuickActions.vue";
import RecentActivities from "@/components/RecentActivities.vue";
import { useUsers } from "@/composables/useUsers";
import StatCard from "@/components/ui/StatCard.vue";
import StatCardSkeleton from "@/components/ui/StatCardSkeleton.vue";
import RecentActivitesSkeleton from "./ui/RecentActivitesSkeleton.vue";
import QuickActionsSkeleton from "./ui/QuickActionsSkeleton.vue";
import axios from "axios";

const { deleteUserById, blockUserById } = useUsers();

const totalWaitingList = ref(0);
const totalAdmins = ref(0);
const popularSource = ref("");
const recentActivitiesList = ref([]);
const loading = ref(true);

const fetchStats = async () => {
    try {
        const res = await axios.get("/dashboard/general");
        const data = res.data || {};
        totalWaitingList.value = data.total_waiting_list ?? totalWaitingList.value;
        totalAdmins.value = data.total_admin ?? totalAdmins.value;
        popularSource.value = data.top_source?.signup_source ?? "";
        recentActivitiesList.value = data.recent_activity ?? [];
    } catch (error) {
        console.error("Error fetching stats:", error);
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchStats();
});
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");

body {
    font-family: "Raleway";
}
.bg-tena-purple {
    background-color: #a855f7;
}
.bg-tena-green {
    background-color: #10b982;
}

.bg-tena-green-dark {
    background-color: #267349;
}

.focus\:ring-tena-green:focus {
    --tw-ring-color: #2e8b57;
}

.focus\:border-tena-green:focus {
    --tw-border-opacity: 1;
    border-color: #2e8b57;
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
</style>
