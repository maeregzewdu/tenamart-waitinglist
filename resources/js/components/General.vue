<template>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Full width stats row -->
        <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Waiting List -->
            <div
                class="bg-white h-[130px] hover:shadow-md rounded-[10px] border border-[#E5E5E5] flex items-center p-6 transform transition-transform duration-300 hover:scale-105"
            >
                <div
                    class="bg-tena-green w-[65px] h-[65px] flex items-center justify-center rounded-md"
                >
                    <i class="ri-file-list-3-fill text-white text-3xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">
                        Total Waiting List
                    </h3>
                    <p class="text-2xl font-semibold text-gray-900">
                        {{ totalWaitingList }}
                    </p>
                </div>
            </div>

            <!-- Total Admins -->
            <div
                class="bg-white h-[130px] hover:shadow-md rounded-[10px] border border-[#E5E5E5] flex items-center p-6 transform transition-transform duration-300 hover:scale-105"
            >
                <div
                    class="bg-tena-green w-[65px] h-[65px] flex items-center justify-center rounded-md"
                >
                    <i class="ri-admin-line text-white text-3xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">
                        Total Admins
                    </h3>
                    <p class="text-2xl font-semibold text-gray-900">
                        {{ totalAdmins }}
                    </p>
                </div>
            </div>

            <!-- Top Source -->
            <div
                class="bg-white h-[130px] rounded-[10px] hover:shadow-md border border-[#E5E5E5] flex items-center p-6 transition-transform duration-300 hover:scale-105"
            >
                <div
                    class="bg-tena-green w-[65px] h-[65px] flex items-center justify-center rounded-md"
                >
                    <i class="ri-pinterest-line text-white text-3xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">
                        Top Source
                    </h3>
                    <p class="text-2xl font-semibold text-gray-900">
                        {{ popularSource }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Left (Recent Activities) -->
        <div class="md:col-span-2">
            <RecentActivities class="mb-8" />
        </div>

        <!-- Right (Quick Actions) -->
        <div>
            <QuickActions class="mb-8" />
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import QuickActions from "@/components/QuickActions.vue";
import RecentActivities from "@/components/RecentActivities.vue";
import { useUsers } from "@/composables/useUsers";
import { useAdmins } from "@/composables/useAdmins";
import axios from "axios";

// Admin count
const { totalAdmins } = useAdmins();

// Users composable
const {
    users: composableUsers,
    loading,
    sources,
    filteredUsers,
    searchQuery,
    sourceFilter,
    deleteUserById,
    blockUserById,
} = useUsers();

// ---------- API stats ----------
const apiTopSource = ref("");
const apiStats = ref({ total: 0, today: 0 });

const fetchStats = async () => {
    try {
        const res = await axios.get("http://localhost:8000/waiting-list/stats");
        const data = res.data || {};
        const statsObj = data.stats || data;
        apiStats.value.total = statsObj.total ?? apiStats.value.total;
        apiStats.value.today = statsObj.today ?? apiStats.value.today;
        apiTopSource.value =
            statsObj.top_source?.signup_source ?? statsObj.topSource ?? "";
    } catch (error) {
        console.error("Error fetching stats:", error);
    }
};
onMounted(() => {
    -fetchWaitingList();
    +fetchAllWaitingList();
    fetchStats();
});

// ---------- computed fallback from local users ----------
const computedTopSource = computed(() => {
    const sourceCounts = {};
    composableUsers.value.forEach((user) => {
        if (!user || !user.source) return;
        sourceCounts[user.source] = (sourceCounts[user.source] || 0) + 1;
    });
    return (
        Object.entries(sourceCounts).reduce(
            (a, b) => (a[1] > b[1] ? a : b),
            ["", 0]
        )[0] || "N/A"
    );
});

// ---------------- API-loaded users ----------------
const apiUsers = ref([]);

const fetchWaitingList = async () => {
    try {
        const response = await axios.get("http://localhost:8000/waiting-list");
        apiUsers.value = response.data.waiting_list.data.map((user) => ({
            id: user.id,
            name: user.name,
            email: user.email,
            source: user.signup_source,
            joinDate: new Date(user.created_at),
        }));
    } catch (error) {
        console.error("Error fetching waiting list:", error);
    }
};

onMounted(() => {
    fetchWaitingList();
});

// Total waiting list
const totalWaitingList = computed(() => apiUsers.value.length);
const fetchAllWaitingList = async () => {
    try {
        const firstRes = await axios.get(
            "http://localhost:8000/waiting-list?page=1"
        );
        const totalPages = firstRes.data.waiting_list.last_page || 1;

        let allUsers = firstRes.data.waiting_list.data;

        const promises = [];
        for (let page = 2; page <= totalPages; page++) {
            promises.push(
                axios.get(`http://localhost:8000/waiting-list?page=${page}`)
            );
        }

        const responses = await Promise.all(promises);
        responses.forEach((res) => {
            allUsers = allUsers.concat(res.data.waiting_list.data);
        });

        apiUsers.value = allUsers.map((user) => ({
            id: user.id,
            name: user.name,
            email: user.email,
            source: user.signup_source,
            joinDate: new Date(user.created_at),
        }));
    } catch (err) {
        console.error("Error fetching all waiting list:", err);
    }
};

// Top source calculation
const topSource = computed(() => {
    if (!apiUsers.value.length) return "N/A";
    const sourceCounts = {};
    apiUsers.value.forEach((user) => {
        const src = user.source || "Unknown";
        sourceCounts[src] = (sourceCounts[src] || 0) + 1;
    });
    return Object.entries(sourceCounts).reduce(
        (a, b) => (a[1] > b[1] ? a : b),
        ["", 0]
    )[0];
});

const popularSource = computed(() => {
    return apiTopSource.value && apiTopSource.value.length > 0
        ? apiTopSource.value
        : computedTopSource.value;
});

const popularSourceCount = computed(() => {
    const source = popularSource.value;
    if (!source || source === "N/A") return 0;
    return apiUsers.value.filter((u) => u.source === source).length;
});

// ---------------- Pagination for API-loaded users ----------------
const itemsPerPage = 9;
const currentPage = ref(1);

const paginatedUsers = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return apiUsers.value.slice(start, end); // <-- use apiUsers, not filteredUsers
});

const totalPages = computed(() =>
    Math.ceil(apiUsers.value.length / itemsPerPage)
);

const changePage = (page) => {
    currentPage.value = page;
};

// ---------- Modals ----------
const showDeleteModal = ref(false);
const showBlockModal = ref(false);
const userToDelete = ref(null);
const userToBlock = ref(null);

const confirmDeleteUser = (user) => {
    userToDelete.value = user;
    showDeleteModal.value = true;
};
const confirmBlockUser = (user) => {
    userToBlock.value = user;
    showBlockModal.value = true;
};

const deleteUser = () => {
    if (userToDelete.value) deleteUserById(userToDelete.value.id);
    showDeleteModal.value = false;
};

const blockUser = () => {
    if (userToBlock.value) blockUserById(userToBlock.value.id);
    showBlockModal.value = false;
};

// ---------- Chart visibility ----------
const showChart = ref(true);

// ---------- Export to CSV ----------
const exportToCSV = () => {
    const headers = ["Name", "Email", "Signup Date", "Source", "Status"];
    const csvContent = [
        headers.join(","),
        ...apiUsers.value.map(
            (user) =>
                `"${user.name}","${
                    user.email
                }","${user.joinDate.toISOString()}","${user.source}","Active"`
        ),
    ].join("\n");

    const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    const url = URL.createObjectURL(blob);
    const link = document.createElement("a");
    link.setAttribute("href", url);
    link.setAttribute("download", "tenamart_waiting_list.csv");
    link.style.visibility = "hidden";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};
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
</style>
