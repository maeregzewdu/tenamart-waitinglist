<template>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Full width stats row -->
        <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Waiting List -->
            <div
                class="bg-white h-[130px] rounded-[10px] border border-[#E5E5E5] flex items-center p-6"
            >
                <div
                    class="bg-tena-green w-[65px] h-[65px] flex items-center justify-center rounded-md"
                >
                    <i
                        class="ri-file-list-3-fill text-white w-[24px] h-[24px]"
                    ></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">
                        Total Waiting List
                    </h3>
                    <p class="text-2xl font-semibold text-gray-900">
                        {{ filteredUsers.length }}
                    </p>
                </div>
            </div>

            <!-- Total Admins -->
            <div
                class="bg-white h-[130px] rounded-[10px] border border-[#E5E5E5] flex items-center p-6"
            >
                <div
                    class="bg-tena-green w-[65px] h-[65px] flex items-center justify-center rounded-md"
                >
                    <i class="ri-admin-line text-white w-[24px] h-[24px]"></i>
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
                class="bg-white h-[130px] rounded-[10px] border border-[#E5E5E5] flex items-center p-6"
            >
                <div
                    class="bg-tena-green w-[65px] h-[65px] flex items-center justify-center rounded-md"
                >
                    <i
                        class="ri-pinterest-line text-white w-[24px] h-[24px]"
                    ></i>
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
import { UserIcon } from "@heroicons/vue/24/solid";
import QuickActions from "@/components/QuickActions.vue";
import RecentActivities from "@/components/RecentActivities.vue";
import { useUsers } from "@/composables/useUsers";

const {
    users,
    loading,
    sources,
    filteredUsers,
    searchQuery,
    sourceFilter,
    deleteUserById,
    blockUserById,
} = useUsers();

const totalAdmins = ref(6); // We have to replace with real admin count from our API

const popularSource = computed(() => {
    const sourceCounts = {};
    users.value.forEach((user) => {
        sourceCounts[user.source] = (sourceCounts[user.source] || 0) + 1;
    });
    return (
        Object.entries(sourceCounts).reduce(
            (a, b) => (a[1] > b[1] ? a : b),
            ["", 0]
        )[0] || "N/A"
    );
});

const popularSourceCount = computed(() => {
    if (!popularSource.value) return 0;
    return users.value.filter((user) => user.source === popularSource.value)
        .length;
});

// Pagination
const itemsPerPage = 9;
const currentPage = ref(1);

const paginatedUsers = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return filteredUsers.value.slice(start, end);
});

const totalPages = computed(() => {
    return Math.ceil(filteredUsers.value.length / itemsPerPage);
});

const changePage = (page) => {
    currentPage.value = page;
};

// Modals
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
    deleteUserById(userToDelete.value.id);
    showDeleteModal.value = false;
};

const blockUser = () => {
    blockUserById(userToBlock.value.id);
    showBlockModal.value = false;
};

// Chart visibility
const showChart = ref(true);

// Export to CSV
const exportToCSV = () => {
    const headers = ["Name", "Email", "Signup Date", "Source", "Status"];
    const csvContent = [
        headers.join(","),
        ...filteredUsers.value.map(
            (user) =>
                `"${user.name}","${user.email}","${user.signupDate}","${user.source}","${user.status}"`
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
